<?php

namespace TDevAgency\NovaPoshtaSdk\Managers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use TDevAgency\NovaPoshtaSdk\Api\Address;
use TDevAgency\NovaPoshtaSdk\Api\AddressGeneral;
use TDevAgency\NovaPoshtaSdk\Api\Common;
use TDevAgency\NovaPoshtaSdk\Api\Counterparty;
use TDevAgency\NovaPoshtaSdk\Api\InternetDocument;

class NovaPoshtaManager
{
    private $key;

    public function setApiKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return Common
     */
    public function commonModel(): Common
    {
        return $this->singleton('NovaPoshtaSdk/Common');
    }

    /**
     * @param $abstract
     * @return mixed
     */
    private function singleton($abstract)
    {
        return App::make($abstract, [$this->httpClient(), $this->getApiKey()]);
    }

    /**
     * @return Client
     */
    private function httpClient(): Client
    {
        return new Client([
            'base_uri' => 'https://api.novaposhta.ua/v2.0/json/',
            'decode_content' => true,
            'verify' => false
        ]);
    }

    private function getApiKey()
    {
        if ($this->key !== null) {
            return $this->key;
        }
        return Config::get('nova_poshta.api_key');
    }

    /**
     * @return Address
     */
    public function addressModel(): Address
    {
        return $this->singleton('NovaPoshtaSdk/Address');
    }

    /**
     * @return Address
     */
    public function addressGeneralModel(): AddressGeneral
    {
        return $this->singleton('NovaPoshtaSdk/AddressGeneral');
    }

    /**
     * @return InternetDocument
     */
    public function internetDocumentModel(): InternetDocument
    {
        return $this->singleton('NovaPoshtaSdk/InternetDocument');
    }

    /**
     * @return Counterparty
     */
    public function counterpartyModel(): Counterparty
    {
        return $this->singleton('NovaPoshtaSdk/Counterparty');
    }
}
