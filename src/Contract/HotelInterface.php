<?php

declare(strict_types=1);

namespace Codenip\Contract;

interface HotelInterface
{
    public function getAvailableRooms(): int;

    public function hasService(string $service): bool;
}
