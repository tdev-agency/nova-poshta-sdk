<?php

namespace TDevAgency\NovaPoshtaSdk\Api;

class Counterparty
{
    use NovaPoshtaApi;

    protected $model = 'Counterparty';

    public function getCounterpartyAddresses()
    {
        $res = $this->request(['calledMethod' => 'getCounterpartyAddresses']);
        return $res;
    }

    public function getCounterparties()
    {
        $res = $this->request(['calledMethod' => 'getCounterparties', "methodProperties" =>
                [
                    'CounterpartyProperty' => 'Sender',
                    'FindByString' => '80953266786']
            ]);
        return $res;
    }
}
