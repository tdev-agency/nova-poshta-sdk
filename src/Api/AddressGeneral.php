<?php


namespace TDevAgency\NovaPoshtaSdk\Api;


use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

class AddressGeneral
{
    use NovaPoshtaApi;

    const CATEGORY_BRANCH = 'Branch';
    const CATEGORY_POSTOMAT = 'Postomat';
    protected $model = 'AddressGeneral';

    /**
     * @param array $props = [
     *     'CityName' => 'city name', // Additional filter my city name
     *     'SettlementRef' => 'settlement_ref',
     *     'CityRef' => 'ref',
     *     'Page' => 1, // Works with limit as pagination
     *     'Limit' => 500, // Max limit per page
     *     'Language' => 'ru' //Default ua
     * ]
     *
     * @param AddressGeneral::CATEGORY_BRANCH|AddressGeneral::CATEGORY_POSTOMAT|null $category
     *
     * @return Collection
     *
     * @throws GuzzleException
     */
    public function getWarehouses(array $props = [], $category = null)
    {
        $response = $this->request(['calledMethod' => 'getWarehouses', 'methodProperties' => $props]);
        $warehouses = $response['data'];
        if ($category !== null) {
            $warehouses = array_filter($warehouses, function ($item) use ($category) {
                return $item['CategoryOfWarehouse'] === $category;
            });
        }

        return Collection::make($warehouses);
    }
}
