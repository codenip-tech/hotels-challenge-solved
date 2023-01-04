<?php

declare(strict_types=1);

namespace Codenip\Http;

use Psr\Http\Message\ResponseInterface;

interface HttpClientInterface
{
    public function get(string $uri, array $options = []): ResponseInterface;
}
