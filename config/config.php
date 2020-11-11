<?php

use TDevAgency\DeliveriesPayments\Drivers\Deliveries\Pickup;
use TDevAgency\DeliveriesPayments\Drivers\Payments\Cash;
use TDevAgency\DeliveriesPayments\Drivers\Payments\CashOnDelivery;
use TDevAgency\NovaPoshta\Drivers\NovaPoshta;

return [
    'api_key' => env('NOVA_POSHTA_API_KEY', null)
];
