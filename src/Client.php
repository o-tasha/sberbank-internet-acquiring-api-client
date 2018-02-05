<?php

namespace OTasha\SberbankInternetAcquiringApiClient;

/**
 *  Клиент API эквайринга
 */
abstract class Client
{
    /**
     * Логин служебной учётной записи продавца
     * @var string
     */
    protected $userName;

    /**
     * Пароль служебной учётной записи продавца
     * @var string
     */
    protected $password;

    /**
     * Запрос регистрации заказа в платежном шлюзе
     * @param $orderNumber int Уникальный идентификатор заказа в системе магазина
     * @param $amount int Сумма платежа в минимальных единицах валюты
     * @param $returnUrl string Адрес, на который требуется перенаправить пользователя в случае успешной оплаты
     * @param $failUrl string Адрес, на который требуется перенаправить пользователя в случае неуспешной оплаты
     * @return array
     */
    abstract public function registerOrder($orderNumber, $amount, $returnUrl, $failUrl = null);

    /**
     * Расширенный запрос состояния заказа в платежном шлюзе
     * @param $orderId string
     * @return array
     */
    abstract public function getOrderStatusExtended($orderId);
}