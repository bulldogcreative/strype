<?php

namespace Bulldog\Strype\Contracts\Resources;

interface TokenInterface extends \Bulldog\Strype\Contracts\ResourceInterface
{
    public function createCard($number, int $expMonth, int $expYear, int $cvc, array $arguments = [], string $key = null): TokenInterface;

    public function createBankAccount($country, $currency, string $accountHolderName, $accountHolderType, $routingNumber, $accountNumber, array $arguments = [], string $key = null): TokenInterface;

    public function createPii($personalIdNumber, string $key = null): TokenInterface;

    public function createAccount(array $arguments = [], string $key = null): TokenInterface;
}
