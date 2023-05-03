<?php

declare(strict_types=1);

namespace App\GeoCode\Infrastructure\Services;

use App\GeoCode\Domain\ValueObject\Address;
use App\GeoCode\Domain\ValueObject\Coordinates;
use App\GeoCode\Infrastructure\Factory\CoordinatesFactory;
use App\GeoCode\Infrastructure\Repository\ResolvedAddressRepository;

class GeoCoordinatesCacheService implements GeoCodersServiceInterface
{
    public function __construct(
        private readonly GeoCodersServiceInterface $decoratedGeoCodersService,
        private readonly CoordinatesFactory $coordinatesFactory,
        private readonly ResolvedAddressRepository $resolvedAddressRepository,
    ) {
    }

    public function getGeoCoordinatesForAddress(Address $address): Coordinates|null
    {
        return $this->coordinatesFactory->prepareCoordinatesFromResolvedAddress($this->resolvedAddressRepository->getByAddress($address)) ?? $this->decoratedGeoCodersService->getGeoCoordinatesForAddress($address);
    }
}
