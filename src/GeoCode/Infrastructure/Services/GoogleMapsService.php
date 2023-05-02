<?php

namespace App\GeoCode\Infrastructure\Services;

use App\GeoCode\Domain\ValueObject\Address;
use App\GeoCode\Domain\ValueObject\Coordinates;
use GuzzleHttp\Client;

class GoogleMapsService implements GeoCodersInterface
{
    public function getGeoCoordinatesForAddress(Address $address): Coordinates|null
    {
        $apiKey = $_ENV["GOOGLE_GEOCODING_API_KEY"];

        $params = [
            'query' => [
                'address' => $address->getStreet(),
                'components' => implode('|', ["country:{$address->getCountry()}", "locality:{$address->getCity()}", "postal_code:{$address->getPostcode()}"]),
                'key' => $apiKey
            ]
        ];

        $client = new Client();

        $response = $client->get('https://maps.googleapis.com/maps/api/geocode/json', $params);

        $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        if (count($data['results']) === 0) {
            return null;
        }

        $firstResult = $data['results'][0];

        if ($firstResult['geometry']['location_type'] !== 'ROOFTOP') {
            return null;
        }

        return new Coordinates(
            lat: $firstResult['geometry']['location']['lat'],
            lng: $firstResult['geometry']['location']['lng']
        );
    }
}