<?php

declare(strict_types=1);

namespace Codenip\Model;

use Codenip\Contract\HotelCollectionInterface;
use Codenip\Contract\HotelInterface;

final class HotelCollection implements HotelCollectionInterface
{
    /**
     * @var HotelInterface[]
     */
    private array $hotels;

    public function get(int $index): HotelInterface
    {
        return $this->hotels[$index];
    }

    public function getIterator(): \Iterator
    {
        return new \ArrayIterator($this->hotels);
    }

    public function add(HotelInterface $hotel): void
    {
        $this->hotels[] = $hotel;
    }
}
