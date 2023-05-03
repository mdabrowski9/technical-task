<?php

declare(strict_types=1);

namespace App\GeoCode\Infrastructure\Repository;

use App\GeoCode\Domain\Repository\GeoCoordinatesRepositoryInterface;
use App\GeoCode\Domain\ValueObject\Address;
use App\GeoCode\Domain\ValueObject\Coordinates;
use App\GeoCode\Infrastructure\Services\GeoCodersServiceInterface;

class GeoCoordinatesRepository implements GeoCoordinatesRepositoryInterface
{
    public function __construct(
        private readonly GeoCodersServiceInterface $geoCodersService,
        private readonly ResolvedAddressRepository $resolvedAddressRepository,
    ) {
    }

    public function getGeoCoordinates(Address $address): Coordinates
    {
        $coordinates =  $this->geoCodersService->getGeoCoordinatesForAddress($address);
        $this->resolvedAddressRepository->saveResolvedAddress($address, $coordinates);

        return $coordinates;
    }
}
