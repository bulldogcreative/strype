<?php

namespace Bulldog\Strype\Contracts\Requests;

interface TokenInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function createCard($number, $expMonth, $expYear, $cvc, $arguments = [], $key = null);

    public function createBankAccount($country, $currency, $accountHolderName, $accountHolderType, $routingNumber, $accountNumber, $arguments = [], $key = null);

    public function createPii($personalIdNumber, $key = null);

    public function createAccount($arguments = [], $key = null);
}
