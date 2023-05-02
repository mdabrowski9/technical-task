<?php

declare(strict_types=1);

namespace App\GeoCode\Infrastructure\Factory;

use App\GeoCode\Domain\ValueObject\Address;
use Symfony\Component\HttpFoundation\Request;

class AddressFactory
{
    public function prepareAddressFromRequest(Request $request): Address
    {
        return new Address(
            $request->get('countryCode', 'lt'),
            $request->get('city', 'vilnius'),
            $request->get('street', 'jasinskio 16'),
            $request->get('postcode', '01112'),
        );
    }
}