<?php


namespace TDevAgency\NovaPoshtaSdk\Api;


use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

class Address
{
    use NovaPoshtaApi;

    protected $model = 'Address';


    /**
     * @return Collection
     * @throws GuzzleException
     */
    public function getCities()
    {
        $cities = $this->request(['calledMethod' => 'getCities']);
        return Collection::make($cities['data']);
    }

    /**
     * @return Collection
     * @throws GuzzleException
     */
    public function getAreas()
    {
        $cities = $this->request(['calledMethod' => 'getAreas']);
        return Collection::make($cities['data']);
    }

    /**
     * @param string $query
     * @param bool $withWarehouses
     * @param int $limit
     * @return Collection
     * @throws GuzzleException
     */
    public function searchSettlements(string $query, bool $withWarehouses = true, int $limit = 5)
    {
        $response = $this->request([
            'calledMethod' => 'searchSettlements',
            'methodProperties' => [
                'CityName' => $query,
                'Limit' => $limit,
            ]]);

        $addresses = [];
        if (isset($response['data'][0]) && $response['data'][0]['TotalCount'] > 0) {
            if ($withWarehouses) {
                $addresses = array_filter($response['data'][0]['Addresses'], function ($address) {
                    return $address['Warehouses'] > 0;
                });
            } else {
                $addresses = $response['data'][0]['Addresses'];
            }
        }

        return Collection::make($addresses);
    }
}
