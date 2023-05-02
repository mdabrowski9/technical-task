<?php

declare(strict_types=1);

namespace App\GeoCode\Infrastructure\Services;

use App\GeoCode\Domain\ValueObject\Address;
use App\GeoCode\Domain\ValueObject\Coordinates;
use App\GeoCode\Infrastructure\Repository\ResolvedAddressRepository;

class GeoCoordinatesService
{
    public function __construct(
        private readonly ResolvedAddressRepository $resolvedAddressRepository,
        private readonly GoogleMapsService $googleMapsService,
        private readonly HereMapsService $hereMapsService,
    )
    {
    }

    public function getGeoCoordinates(Address $address): Coordinates|null
    {
        $coordinates = $this->resolvedAddressRepository->getByAddress($address) ?? $this->googleMapsService->getGeoCoordinatesForAddress($address);
        $coordinates = $coordinates ?? $this->hereMapsService->getGeoCoordinatesForAddress($address);

        return $coordinates;
    }
}