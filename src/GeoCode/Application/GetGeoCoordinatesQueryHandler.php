<?php

declare(strict_types=1);

namespace App\GeoCode\Application;

use App\GeoCode\Domain\Repository\GeoCoordinatesRepositoryInterface;
use App\GeoCode\Domain\ValueObject\Coordinates;
use App\Shared\QueryHandlerInterface;

class GetGeoCoordinatesQueryHandler implements QueryHandlerInterface
{

    public function __construct(
        private readonly GeoCoordinatesRepositoryInterface $geoCoordinatesRepository,
    )
    {
    }

    public function __invoke(GetGeoCoordinatesQuery $query): Coordinates
    {
        return $this->geoCoordinatesRepository->getGeoCoordinates($query->getAddress());
    }
}