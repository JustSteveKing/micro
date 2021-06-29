<?php

declare(strict_types=1);

namespace App\Handlers;

use JustSteveKing\Config\Repository;
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
        $response = new Response(
            status: Http::OK,
        );

        // JSON:API spec
        $response = $response->withHeader(
            name: 'Content-Type',
            value: 'application/vnd.api+json',
        );

        $response->getBody()->write(
            string: json_encode([
                'name' => $this->config->get('app.name'),
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
        );

        return $response;
    }
}