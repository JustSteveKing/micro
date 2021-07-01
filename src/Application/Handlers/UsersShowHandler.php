<?php

declare(strict_types=1);

namespace App\Handlers;

use Domain\User\ShowUserQuery;
use JustSteveKing\Micro\Http\ApiResponseFactory;
use League\Tactician\CommandBus;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Routing\RouteContext;

class UsersShowHandler implements RequestHandlerInterface
{
    public function __construct(
        private CommandBus $bus,
    ) {}

    /**
     * @inheritDoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = RouteContext::fromRequest(
            serverRequest: $request,
        )->getRoute()->getArgument('id');

        $user = $this->bus->handle(new ShowUserQuery(id: $id));

        return ApiResponseFactory::make(
            data: [
                'data' => $user
            ],
            headers: [
                'Content-Type' => 'application/vnd.api+json'
            ],
        );
    }
}
