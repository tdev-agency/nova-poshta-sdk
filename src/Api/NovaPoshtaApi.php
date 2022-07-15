<?php

namespace TDevAgency\NovaPoshtaSdk\Api;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RuntimeException;

trait NovaPoshtaApi
{
    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @var string
     */
    private $apiKey;

    public function __construct(Client $httpClient, $apiKey)
    {
        $this->httpClient = $httpClient;
        $this->apiKey = $apiKey;
    }

    /**
     * @param $options
     * @param string $method
     * @param string $uri
     * @return mixed
     * @throws GuzzleException
     * @throws Exception
     */
    protected function request($options, string $method = 'POST', string $uri = '')
    {
        $request = $this->httpClient->request($method, $uri, [
            'json' => array_merge([
                "modelName" => $this->model,
                "apiKey" => $this->apiKey
            ], $options)
        ]);

        $data = json_decode($request->getBody()->getContents(), true);
        if ($data['success']) {
            return $data;
        } elseif (in_array(20000900746, $data['errorCodes'])) {
            return $data;
        }
        throw new RuntimeException($data['errors'][0]);
    }
}
