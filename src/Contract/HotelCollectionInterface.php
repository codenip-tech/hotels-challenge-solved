<?php

declare(strict_types=1);

namespace Codenip\Contract;

interface HotelCollectionInterface {
    public function get(int $index): HotelInterface;

    public function getIterator(): \Iterator;

    public function add(HotelInterface $hotel): void;
}
