<?php

declare(strict_types=1);

namespace App\GeoCode\Domain\ValueObject;

use JsonSerializable;

class Coordinates implements JsonSerializable
{
    public function __construct(
        private float $lat,
        private float $lng
    ) {
    }

    public function getLat(): float
    {
        return $this->lat;
    }

    public function setLat(float $lat): void
    {
        $this->lat = $lat;
    }

    public function getLng(): float
    {
        return $this->lng;
    }

    public function setLng(float $lng): void
    {
        $this->lng = $lng;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'lat' => $this->getLat(),
            'lng' => $this->getLng()
        ];
    }
}
