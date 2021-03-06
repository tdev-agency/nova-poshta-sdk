<?php

namespace TDevAgency\NovaPoshtaSdk\Api;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

class Address
{
    use NovaPoshtaApi;

    protected $model = 'Address';

    /**
     * @param array $methodProperties = [
     *     'Ref' => string,
     *     'Page' => int,
     *     'FindByString' => string
     * ]
     * @return Collection
     * @throws GuzzleException
     */
    public function getCities(array $methodProperties = []): Collection
    {
        $request = ['calledMethod' => 'getCities'];
        if (!empty($methodProperties)) {
            $request = array_merge($request, compact('methodProperties'));
        }

        $cities = $this->request($request);
        return Collection::make($cities['data']);
    }

    /**
     * @return Collection
     * @throws GuzzleException
     */
    public function getAreas(): Collection
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
    public function searchSettlements(string $query, bool $withWarehouses = true, int $limit = 5): Collection
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
