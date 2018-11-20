<?php

namespace Bulldog\Strype\Contracts\Resources;

interface TokenInterface extends \Bulldog\Strype\Contracts\ResourceInterface
{
    public function createCard(int $number, int $expMonth, int $expYear, int $cvc, array $arguments = [], string $key = null): TokenInterface;

    public function createBankAccount(string $country, string $currency, string $accountHolderName, string $accountHolderType, int $routingNumber, int $accountNumber, array $arguments = [], string $key = null): TokenInterface;

    public function createPii(string $personalIdNumber, string $key = null): TokenInterface;

    public function createAccount(array $arguments = [], string $key = null): TokenInterface;
}
