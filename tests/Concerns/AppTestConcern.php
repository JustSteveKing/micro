<?php

declare(strict_types=1);

namespace Tests\Concerns;

use InvalidArgumentException;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;
use Slim\App;
use Slim\Psr7\Factory\ServerRequestFactory;
use UnexpectedValueException;

trait AppTestConcern
{
    protected App $app;

    protected ContainerInterface $container;

    protected function setUp(): void
    {
        $this->app = require __DIR__ . '/../../bootstrap/app.php';

        $container = $this->app->getContainer();

        if (is_null($container)) {
            throw new UnexpectedValueException(
                message: "Container needs to be initialized.",
            );
        }

        $this->container = $container;
    }

    protected function mock(string $class): MockObject
    {
        if (! class_exists($class)) {
            throw new InvalidArgumentException(
                message: "Class not found: [$class]",
            );
        }

        $mock = $this->getMockBuilder($class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->container->set(
            $class,
            $mock,
        );

        return $mock;
    }

    protected function createRequest(
        string $method,
        string|UriInterface $uri,
        array $serverParams = [],
    ): ServerRequestInterface {
        return (new ServerRequestFactory())->createServerRequest(
            method: $method,
            uri: $uri,
            serverParams: $serverParams,
        );
    }

    protected function createJsonRequest(
        string $method,
        string|UriInterface $uri,
        array $data = null,
    ): ServerRequestInterface {
        $request = $this->createRequest(
            method: $method,
            uri: $uri,
        );

        if ($data !== null) {
            $request = $request->withParsedBody(
                data: $data,
            );
        }

        return $request->withHeader(
            name: 'Content-Type',
            value: 'application/json');
    }

    protected function assertJsonData(array $expected, ResponseInterface $response): void
    {
        $actual = (string) $response->getBody();

        $this->assertSame(
            expected: $expected,
            actual: (array) json_decode($actual, true, 512, JSON_THROW_ON_ERROR),
        );
    }
}
