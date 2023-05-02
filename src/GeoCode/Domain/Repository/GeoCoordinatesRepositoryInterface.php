<?php

declare(strict_types=1);

namespace App\GeoCode\Domain\Repository;

use App\GeoCode\Domain\ValueObject\Address;
use App\GeoCode\Domain\ValueObject\Coordinates;

interface GeoCoordinatesRepositoryInterface
{
    public function getGeoCoordinates(Address $address): Coordinates;
}