<?php

declare(strict_types=1);

namespace App\GeoCode\Infrastructure\Factory;

use App\GeoCode\Domain\Entity\ResolvedAddress;
use App\GeoCode\Domain\ValueObject\Coordinates;

class CoordinatesFactory
{
    public function prepareCoordinatesFromResolvedAddress(ResolvedAddress|null $resolvedAddress): Coordinates|null
    {
        if ($resolvedAddress === null || $resolvedAddress->getLng() === null || $resolvedAddress->getLat() === null) {
            return null;
        }

        return new Coordinates(
            (float) $resolvedAddress->getLat(),
            (float) $resolvedAddress->getLng(),
        );
    }
}
