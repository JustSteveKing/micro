<?php

declare(strict_types=1);

namespace App\Handlers;

use Domain\User\Queries\ListUsersQuery;
use JustSteveKing\Micro\Http\ApiResponseFactory;
use League\Tactician\CommandBus;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TestHandler implements RequestHandlerInterface
{
    public function __construct(
        private CommandBus $bus,
    ) {}

    /**
     * @inheritDoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $results = $this->bus->handle(new ListUsersQuery());

        return ApiResponseFactory::make(
            data: [
                'data' => $results
            ],
            headers: [
                'Content-Type' => 'application/vnd.api+json'
            ],
        );
    }
}
