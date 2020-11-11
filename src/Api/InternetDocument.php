<?php


namespace TDevAgency\NovaPoshtaSdk\Api;


use GuzzleHttp\Exception\GuzzleException;

class InternetDocument
{
    use NovaPoshtaApi;

    const CARGO_TYPE_CARGO = 'Cargo';
    const CARGO_TYPE_DOCUMENTS = 'Documents';
    const CARGO_TYPE_TIRES_WHEELS = 'TiresWheels';
    const CARGO_TYPE_PALLET = 'Pallet';
    const CARGO_TYPE_MONEY = 'Money';

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
        $cost = 300,
        $cargoType = self::CARGO_TYPE_CARGO,
        $seatsAmount = 1,
        $optionalParams = [])
    {

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
