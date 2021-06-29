<?php

declare(strict_types=1);

namespace App\Handlers;

use JustSteveKing\Config\Repository;
use JustSteveKing\Micro\Http\ApiResponseFactory;
use JustSteveKing\StatusCode\Http;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;

class RootHandler implements RequestHandlerInterface
{
    public function __construct(
        private Repository $config,
    ) {}

    /**
     * @inheritDoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return ApiResponseFactory::make(
            data: ['name' => $this->config->get('app.name')],
            headers: [
                'Content-Type' => 'application/vnd.api+json'
            ],
        );
    }
}