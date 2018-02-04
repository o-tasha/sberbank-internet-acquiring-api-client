<?php

namespace OTasha\SberbankInternetAcquiringApiClient;

/**
 * Класс-фабрика для создания конкретного экземпляра класса Client в зависимости от интерфейса доступа к API
 */
class ClientFactory
{
    CONST REST = 0;
    CONST SOAP = 1;

    /**
     * @param $interfaceType int
     * @param $userName string
     * @param $password string
     * @param $testMode bool
     * @return Client
     * @throws \Exception|\Throwable
     */
    public static function create($interfaceType, $userName, $password, $testMode = true)
    {
        switch ($interfaceType) {
            case self::REST:
                $httpClient = new HttpClient();
                return new RESTClent($userName, $password, $httpClient, $testMode);
            case self::SOAP:
                throw new \Exception('This type of interface is not yet supported');
            default:
                throw new \Exception('Unknown interface type');
        }
    }
}