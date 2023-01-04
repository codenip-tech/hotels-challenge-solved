<?php

declare(strict_types=1);

namespace Codenip\Service;

use Codenip\Contract\HotelInterface;
use Codenip\Contract\ReaderInterface;
use Codenip\Http\Endpoint;
use Codenip\Http\HttpClientInterface;

final class HotelsByRooms
{
    private HttpClientInterface $httpClient;
    private ReaderInterface $reader;

    public function __construct(HttpClientInterface $httpClient, ReaderInterface $reader)
    {
        $this->httpClient = $httpClient;
        $this->reader = $reader;
    }

    public function search(int $min, int $max): int
    {
        $response = $this->httpClient->get(Endpoint::GET_HOTELS);

        $collection = $this->reader->read($response->getBody()->getContents());

        $total = 0;

        $iterator = $collection->getIterator();
        $iterator->rewind();

        while ($iterator->valid()) {
            /** @var HotelInterface $current */
            $current = $iterator->current();

            if ($current->getAvailableRooms() >= $min && $current->getAvailableRooms() <= $max) {
                ++$total;
            }

            $iterator->next();
        }

        return $total;
    }
}
