<?php

declare(strict_types=1);

namespace Codenip\Reader;

use Codenip\Contract\HotelCollectionInterface;
use Codenip\Contract\ReaderInterface;
use Codenip\Model\Hotel;
use Codenip\Model\HotelCollection;

final class JsonReader implements ReaderInterface
{
    public function read(string $input): HotelCollectionInterface
    {
        $hotelsData = \json_decode($input, true);

        $collection = new HotelCollection();

        foreach ($hotelsData as $hotelData) {
            $collection->add(
                new Hotel(
                    $hotelData['id'],
                    $hotelData['availableRooms'],
                    $hotelData['pool'],
                    $hotelData['gym'],
                    $hotelData['restaurant'],
                )
            );
        }

        return $collection;
    }
}
