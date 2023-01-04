<?php

declare(strict_types=1);

namespace Codenip\Contract;

interface ReaderInterface
{
    public function read(string $input): HotelCollectionInterface;
}
