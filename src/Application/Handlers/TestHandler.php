<?php

declare(strict_types=1);

namespace App\Handlers;

use Doctrine\DBAL\Connection;
use JustSteveKing\Micro\Http\ApiResponseFactory;
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
