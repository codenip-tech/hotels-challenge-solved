<?php

declare(strict_types=1);

namespace Codenip\Model;

use Codenip\Contract\HotelInterface;

final class Hotel implements HotelInterface
{
    private int $id;
    private int $availableRooms;
    private bool $pool;
    private bool $gym;
    private bool $restaurant;

    public function __construct(int $id, int $availableRooms, bool $pool, bool $gym, bool $restaurant)
    {
        $this->id = $id;
        $this->availableRooms = $availableRooms;
        $this->pool = $pool;
        $this->gym = $gym;
        $this->restaurant = $restaurant;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAvailableRooms(): int
    {
        return $this->availableRooms;
    }

    public function hasService(string $service): bool
    {
        return $this->$service;
    }

    public function isPool(): bool
    {
        return $this->pool;
    }

    public function isGym(): bool
    {
        return $this->gym;
    }

    public function isRestaurant(): bool
    {
        return $this->restaurant;
    }
}
