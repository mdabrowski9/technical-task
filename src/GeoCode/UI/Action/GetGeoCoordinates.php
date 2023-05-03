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
    public function __construct(
        private readonly AddressFactory $addressFactory,
        private readonly QueryBusInterface $queryBus,
    ) {
    }

    /**
     * @Route(path="/coordinates", name="geocode")
     * @param Request $request
     * @return GeoCoordinatesResponse
     */
    public function getGeoCoordinatesAction(Request $request): GeoCoordinatesResponse
    {
        $address = $this->addressFactory->prepareAddressFromRequest($request);

        return $this->queryBus->handle(new GetGeoCoordinatesQuery($address));
    }
}
