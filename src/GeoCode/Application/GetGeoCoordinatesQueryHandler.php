<?php

declare(strict_types=1);

namespace App\GeoCode\Application;

use App\GeoCode\Domain\GeoCoordinatesResponse;
use App\GeoCode\Domain\Repository\GeoCoordinatesRepositoryInterface;
use App\Shared\QueryHandlerInterface;

class GetGeoCoordinatesQueryHandler implements QueryHandlerInterface
{
    private const HTTP_OK = 200;
    private const HTTP_NOT_FOUND_MESSAGE = 'Not found coordinates in cache or any implemented geoCoder service.';

    public function __construct(
        private readonly GeoCoordinatesRepositoryInterface $geoCoordinatesRepository,
    ) {
    }

    public function __invoke(GetGeoCoordinatesQuery $query): GeoCoordinatesResponse
    {
        $coordinates = $this->geoCoordinatesRepository->getGeoCoordinates($query->getAddress()) ?? self::HTTP_NOT_FOUND_MESSAGE;

        return new GeoCoordinatesResponse(
            json_encode($coordinates, JSON_THROW_ON_ERROR),
            self::HTTP_OK,
            [],
            true
        );
    }
}
