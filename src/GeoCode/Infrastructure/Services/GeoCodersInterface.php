<?php

declare(strict_types=1);

namespace App\GeoCode\Infrastructure\Services;

use App\GeoCode\Domain\ValueObject\Address;
use App\GeoCode\Domain\ValueObject\Coordinates;

interface GeoCodersInterface
{
    public function getGeoCoordinatesForAddress(Address $address): Coordinates|null;
}