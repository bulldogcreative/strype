<?php

namespace Bulldog\Strype\Contracts\Resources;

use Bulldog\Strype\Contracts\ResourceInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;

interface TokenInterface extends ResourceInterface, RetrieveInterface
{
    public function createCard(int $number, int $expMonth, int $expYear, int $cvc, array $arguments = [], string $key = null): TokenInterface;

    public function createBankAccount(string $country, string $currency, string $accountHolderName, string $accountHolderType, int $routingNumber, int $accountNumber, array $arguments = [], string $key = null): TokenInterface;

    public function createPii(string $personalIdNumber, string $key = null): TokenInterface;

    public function createAccount(array $arguments = [], string $key = null): TokenInterface;
}
