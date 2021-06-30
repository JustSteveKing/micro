<?php

declare(strict_types=1);

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use JustSteveKing\Config\Repository;
use JustSteveKing\ConfigLoader\Loader;
use JustSteveKing\Micro\Contracts\KernelContract;
use JustSteveKing\Micro\Kernel;
use JustSteveKing\Micro\Routing\Dispatcher;
use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\Locator\InMemoryLocator;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Slim\CallableResolver;
use Slim\Handlers\Strategies\RequestHandler;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Factory\UriFactory;
use Slim\Routing\RouteCollector;
use Slim\Routing\RouteResolver;

return [
    KernelContract::class => function (ContainerInterface $container) {
        $callableResolver = new CallableResolver(
            container: $container,
        );
        $responseFactory = new ResponseFactory();
        $uriFactory = new UriFactory();

        $routeCollector = new RouteCollector(
            responseFactory: $responseFactory,
            callableResolver: $callableResolver,
            container: $container,
            defaultInvocationStrategy: new RequestHandler(),
        );

        $routeResolver = new RouteResolver(
            routeCollector: $routeCollector,
            dispatcher: new Dispatcher(
                routeCollector: $routeCollector,
                uriFactory: $uriFactory,
            ),
        );

        return Kernel::boot(
            basePath: __DIR__ . '/../',
            container: $container,
            callableResolver: $callableResolver,
            routeCollector: $routeCollector,
            routeResolver: $routeResolver,
        );
    },

    LoggerInterface::class => function (ContainerInterface $container) {
        $logger = new Logger(
            name: 'micro',
        );

        $logger->pushProcessor(
            callback: new UidProcessor()
        );

        $logger->pushHandler(
            handler: new StreamHandler(
                stream: 'php://stderr',
                level: Logger::DEBUG,
            ),
        );

        return $logger;
    },

    Repository::class => function () {
        $loader = new Loader(
            basePath: dirname(__DIR__ . '/../'),
        );

        $loader->load(
            name: 'app',
        );
        $loader->load(
            name: 'database',
        );

        return Repository::build(
            items: $loader->config(),
        );
    },

    Connection::class => function (ContainerInterface $container) {
        /**
         * @var Repository
         */
        $config = $container->get(
            Repository::class
        );

        return DriverManager::getConnection(
            params: $config->get('database'),
            config: new Configuration(),
        );
    },

    PDO::class => function (ContainerInterface $container) {
        return $container->get(
            id: Connection::class,
        )->getWrappedConnection();
    },

    CommandBus::class => function (ContainerInterface $container) {
        $locator = new InMemoryLocator();

        $locator->addHandler(
            new \App\Articles\ListArticlesHandler($container->get(Connection::class)),
            \App\Articles\ListArticlesCommand::class,
        );

        $handlerMiddleware = new CommandHandlerMiddleware(
            commandNameExtractor: new ClassNameExtractor(),
            handlerLocator: $locator,
            methodNameInflector: new HandleInflector(),
        );

        return new CommandBus(
            middleware: [$handlerMiddleware],
        );
    },
];
