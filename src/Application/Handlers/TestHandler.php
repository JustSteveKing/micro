<?php

declare(strict_types=1);

namespace App\Handlers;

use Doctrine\DBAL\Connection;
use JustSteveKing\StatusCode\Http;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Response;

class TestHandler implements \Psr\Http\Server\RequestHandlerInterface
{
    public function __construct(private Connection $connection) {}
    /**
     * @inheritDoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $query = 'SELECT uuid, title FROM articles';

        $statement = $this->connection->prepare(
            sql: $query,
        );

        $results = $statement->executeQuery()->fetchAllAssociative();

        $response = new Response(
            status: Http::OK,
        );

        $response = $response->withHeader(
            name: 'Content-Type',
            value: 'application/vnd.api+json',
        );

        $response->getBody()->write(
            string: json_encode([
                'data' => $results,
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
        );

        return $response;
    }
}
