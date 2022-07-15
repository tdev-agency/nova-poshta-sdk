<?php

namespace TDevAgency\NovaPoshtaSdk;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TDevAgency\NovaPoshtaSdk\Api\Address;
use TDevAgency\NovaPoshtaSdk\Api\AddressGeneral;
use TDevAgency\NovaPoshtaSdk\Api\Common;
use TDevAgency\NovaPoshtaSdk\Api\Counterparty;
use TDevAgency\NovaPoshtaSdk\Api\InternetDocument;
use TDevAgency\NovaPoshtaSdk\Facades\NovaPoshta;

class NovaPoshtaSdkServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->alias('NovaPoshta', NovaPoshta::class);

        $classes = [
            'Common' => Common::class,
            'Address' => Address::class,
            'AddressGeneral' => AddressGeneral::class,
            'Counterparty' => Counterparty::class,
            'InternetDocument' => InternetDocument::class,
        ];

        foreach ($classes as $className => $class) {
            $this->app->singleton("NovaPoshtaSdk/$className", function (Application $app, $options) use ($class) {
                list($httpClient, $apiKey) = $options;
                return new $class($httpClient, $apiKey);
            });
        }

        $this->mergeConfigFrom(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php', 'nova_poshta');
    }
}
