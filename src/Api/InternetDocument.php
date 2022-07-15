<?php

namespace TDevAgency\NovaPoshtaSdk\Api;

use GuzzleHttp\Exception\GuzzleException;

class InternetDocument
{
    use NovaPoshtaApi;

    public const CARGO_TYPE_CARGO = 'Cargo';
    public const CARGO_TYPE_DOCUMENTS = 'Documents';
    public const CARGO_TYPE_TIRES_WHEELS = 'TiresWheels';
    public const CARGO_TYPE_PALLET = 'Pallet';
    public const CARGO_TYPE_MONEY = 'Money';

    protected $model = 'InternetDocument';

    /**
     * @param $citySender
     * @param $cityRecipient
     * @param $weight
     * @param $serviceType
     * @param int $cost
     * @param string $cargoType
     * @param int $seatsAmount
     * @param array $optionalParams = [
     *     'PackCalculate' => [
     *          'PackCount' => 1,
     *          'PackRef' => 'pack_ref'
     *      ],
     *      'RedeliveryCalculate' => [
     *          'CargoType' => 'Money',
     *          'Amount' => 1
     *      ]
     * ]
     * @return mixed
     * @throws GuzzleException
     */
    public function getDocumentPrice(
        $citySender,
        $cityRecipient,
        $weight,
        $serviceType,
        int $cost = 300,
        string $cargoType = self::CARGO_TYPE_CARGO,
        int $seatsAmount = 1,
        array $optionalParams = []
    ) {
        $properties = [
            "CitySender" => $citySender,
            "CityRecipient" => $cityRecipient,
            "Weight" => $weight,
            "ServiceType" => $serviceType,
            "Cost" => $cost,
            "CargoType" => $cargoType,
            "SeatsAmount" => $seatsAmount
        ];

        if (!empty($optionalParams)) {
            $properties = array_merge($properties, $optionalParams);
        }

        $response = $this->request(['calledMethod' => 'getDocumentPrice', 'methodProperties' => $properties]);

        return $response['data'];
    }
}
