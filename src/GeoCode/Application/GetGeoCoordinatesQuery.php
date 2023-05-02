<?php

declare(strict_types=1);

namespace App\GeoCode\Application;

use App\GeoCode\Domain\ValueObject\Address;
use App\Shared\QueryInterface;

class GetGeoCoordinatesQuery implements QueryInterface
{
    public function __construct(
        private readonly Address $address,
    )
    {
    }

    /** @return Address */
    public function getAddress(): Address
    {
        return $this->address;
    }
}