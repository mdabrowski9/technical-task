<?php

declare(strict_types=1);

namespace App\GeoCode\Infrastructure\Repository;

use App\GeoCode\Domain\Repository\GeoCoordinatesRepositoryInterface;
use App\GeoCode\Domain\ValueObject\Address;
use App\GeoCode\Domain\ValueObject\Coordinates;
use App\GeoCode\Infrastructure\Services\GeoCoordinatesService;

class GeoCoordinatesRepository implements GeoCoordinatesRepositoryInterface
{
    public function __construct(
        private readonly GeoCoordinatesService $geoCoordinatesService,
        private readonly ResolvedAddressRepository $resolvedAddressRepository,
    )
    {
    }

    public function getGeoCoordinates(Address $address): Coordinates
    {
        $coordinates =  $this->geoCoordinatesService->getGeoCoordinates($address);
        $this->resolvedAddressRepository->saveResolvedAddress($address, $coordinates);
        return $this->geoCoordinatesService->getGeoCoordinates($address);
    }
}