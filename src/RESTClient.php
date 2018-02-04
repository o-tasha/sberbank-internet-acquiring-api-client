<?php

namespace OTasha\SberbankInternetAcquiringApiClient;

/**
 *  Клиент REST API эквайринга
 */
class RESTClient extends Client
{
    CONST TEST_REST_URL = 'https://3dsec.sberbank.ru/payment/rest/';
    CONST REST_URL = 'https://securepayments.sberbank.ru/payment/rest/';

    /**
     * @var string
     */
    private $restUrl;

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * Constructor
     *
     * @param string $userName Логин служебной учётной записи продавца
     * @param string $password Пароль служебной учётной записи продавца
     * @param HttpClient $httpClient
     * @param bool $testMode
     */
    public function __construct($userName, $password, $httpClient, $testMode = true)
    {
        $this->userName = $userName;
        $this->password = $password;
        if ($testMode === false) {
            $this->restUrl = self::REST_URL;
        } else {
            $this->restUrl = self::TEST_REST_URL;
        }
    }

    /**
     * @inheritdoc
     *
     * @return array
     */
    public function registerOrder($orderNumber, $amount, $returnUrl)
    {
        $requestUrl = $this->restUrl . 'register.do';

        $data = [
            'userName' => $this->userName,
            'password' => $this->password,
            'orderNumber' => $orderNumber,
            'amount' => $amount,
            'returnUrl' => $returnUrl,
        ];

        $headers = [
            'Cache-Control: no-cache',
        ];

        $response = $this->httpClient->request($requestUrl, 'GET', $headers, $data);

        return json_decode($response, true);
    }

    /**
     * @inheritdoc
     *
     * @return array
     */
    public function getOrderStatusExtended($orderId)
    {
        $requestUrl = $this->restUrl . 'getOrderStatusExtended.do';

        $data = [
            'userName' => $this->userName,
            'password' => $this->password,
            'orderId' => $orderId,
        ];

        $headers = [
            'Cache-Control: no-cache',
        ];

        $response = $this->httpClient->request($requestUrl, 'GET', $headers, $data);

        return json_decode($response, true);
    }

}