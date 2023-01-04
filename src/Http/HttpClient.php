<?php

declare(strict_types=1);

namespace Codenip\Http;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

final class HttpClient implements HttpClientInterface
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get(string $uri, array $options = []): ResponseInterface
    {
        return $this->client->get($uri, $options);
    }
}
