<?php

declare(strict_types=1);

namespace App\GeoCode\UI\Action;

use App\GeoCode\Application\GetGeoCoordinatesQuery;
use App\GeoCode\Domain\GeoCoordinatesResponse;
use App\GeoCode\Infrastructure\Factory\AddressFactory;
use App\Shared\QueryBusInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GetGeoCoordinates
{
    private const HTTP_OK = 200;

    public function __construct(
        private readonly AddressFactory $addressFactory,
        private readonly QueryBusInterface $queryBus,
    )
    {
    }

    /**
     * @Route(path="/coordinates", name="geocode")
     * @param Request $request
     * @return GeoCoordinatesResponse
     */
    public function getGeoCoordinatesAction(Request $request): GeoCoordinatesResponse
    {
        $address = $this->addressFactory->prepareAddressFromRequest($request);
        $responseData = $this->queryBus->handle(new GetGeoCoordinatesQuery($address));

        return new GeoCoordinatesResponse(
            data: $responseData,
            status: self::HTTP_OK,
            headers: [],
            json: false
        );
    }
}