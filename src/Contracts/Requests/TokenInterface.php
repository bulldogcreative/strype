<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Requests;

interface TokenInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function createCard($number, int $expMonth, int $expYear, int $cvc, array $arguments = [], string $key = null): TokenInterface;

    public function createBankAccount($country, $currency, string $accountHolderName, $accountHolderType, $routingNumber, $accountNumber, array $arguments = [], string $key = null): TokenInterface;

    public function createPii($personalIdNumber, string $key = null): TokenInterface;

    public function createAccount(array $arguments = [], string $key = null): TokenInterface;
}
