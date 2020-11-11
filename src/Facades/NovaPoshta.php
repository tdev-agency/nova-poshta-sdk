<?php

namespace TDevAgency\NovaPoshtaSdk\Facades;

use Illuminate\Support\Facades\Facade;
use TDevAgency\NovaPoshtaSdk\Api\Address;
use TDevAgency\NovaPoshtaSdk\Api\AddressGeneral;
use TDevAgency\NovaPoshtaSdk\Api\Common;
use TDevAgency\NovaPoshtaSdk\Api\Counterparty;
use TDevAgency\NovaPoshtaSdk\Api\InternetDocument;
use TDevAgency\NovaPoshtaSdk\managers\NovaPoshtaManager;

/**
 * Class NovaPoshta
 * @package TDevAgency\NovaPoshtaSdk\Facades
 *
 * @method static Common commonModel()
 * @method static Address addressModel()
 * @method static AddressGeneral addressGeneralModel()
 * @method static Counterparty counterpartyModel()
 * @method static InternetDocument internetDocumentModel()
 */
class NovaPoshta extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return NovaPoshtaManager::class;
    }

}
