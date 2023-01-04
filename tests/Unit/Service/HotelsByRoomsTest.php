<?php

declare(strict_types=1);

namespace Codenip\Tests\Unit\Service;

use Codenip\Contract\ReaderInterface;
use Codenip\Http\HttpClientInterface;
use Codenip\Model\Hotel;
use Codenip\Model\HotelCollection;
use Codenip\Service\HotelsByRooms;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class HotelsByRoomsTest extends TestCase
{
    private const ENDPOINT = '/v3/6a7b91d6-377a-491d-a084-2066cf911065';

    private HttpClientInterface $httpClient;
    private ReaderInterface $reader;

    private HotelsByRooms $service;

    public function setUp(): void
    {
        $this->httpClient = $this->createMock(HttpClientInterface::class);
        $this->reader = $this->createMock(ReaderInterface::class);

        $this->service = new HotelsByRooms($this->httpClient, $this->reader);
    }

    public function testGetHotelsByRoomRange(): void
    {
        $file = \file_get_contents(__DIR__ . '/../../../data/hotels.json');

        $data = \json_decode(\file_get_contents(__DIR__ . '/../../../data/hotels.json'), true);

        $collection = new HotelCollection();

        foreach ($data as $item) {
            $collection->add(
                new Hotel(
                    $item['id'],
                    $item['availableRooms'],
                    $item['pool'],
                    $item['gym'],
                    $item['restaurant'],
                )
            );
        }

        $response = new Response(200, [], $file);

        $this->httpClient
            ->expects($this->once())
            ->method('get')
            ->with(self::ENDPOINT)
            ->willReturn($response);

        $this->reader
            ->expects($this->once())
            ->method('read')
            ->with(
                $this->callback(function (string $content) use ($file): bool {
                    return $content === $file;
                })
            )
            ->willReturn($collection);

        $total = $this->service->search(2, 8);

        self::assertEquals(2, $total);
    }
}
