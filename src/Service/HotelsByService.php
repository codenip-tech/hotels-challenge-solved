<?php

declare(strict_types=1);

namespace Codenip\Service;

use Codenip\Contract\HotelInterface;
use Codenip\Contract\ReaderInterface;
use Codenip\Http\Endpoint;
use Codenip\Http\HttpClientInterface;

final class HotelsByService
{
    private HttpClientInterface $httpClient;
    private ReaderInterface $reader;

    public function __construct(HttpClientInterface $httpClient, ReaderInterface $reader)
    {
        $this->httpClient = $httpClient;
        $this->reader = $reader;
    }

    public function search(string $service): int
    {
        $response = $this->httpClient->get(Endpoint::GET_HOTELS);

        $collection = $this->reader->read($response->getBody()->getContents());

        $total = 0;

        /** @var HotelInterface $item */
        foreach ($collection->getIterator() as $item) {
            if ($item->hasService($service)) {
                ++$total;
            }
        }

        return $total;
    }
}
