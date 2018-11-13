<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Requests;

interface TokenInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function createCard($number, int $expMonth, int $expYear, int $cvc, $arguments = [], $key = null);

    public function createBankAccount($country, $currency, string $accountHolderName, $accountHolderType, $routingNumber, $accountNumber, $arguments = [], $key = null);

    public function createPii($personalIdNumber, $key = null);

    public function createAccount($arguments = [], $key = null);
}
