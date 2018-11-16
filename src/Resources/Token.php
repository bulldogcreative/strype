<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Contracts\Resources\TokenInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Retrieve;

class Token extends Resource implements TokenInterface, RetrieveInterface
{
    use Retrieve;

    public function createCard($number, int $expMonth, int $expYear, int $cvc, array $arguments = [], string $key = null): TokenInterface
    {
        $arguments['card']['number'] = $number;
        $arguments['card']['exp_month'] = $expMonth;
        $arguments['card']['exp_year'] = $expYear;
        $arguments['card']['cvc'] = $cvc;

        $this->stripe('create', $arguments, $key);

        return $this;
    }

    public function createBankAccount($country, $currency, string $accountHolderName, $accountHolderType, $routingNumber, $accountNumber, array $arguments = [], string $key = null): TokenInterface
    {
        $arguments['bank_account']['country'] = $country;
        $arguments['bank_account']['currency'] = $currency;
        $arguments['bank_account']['account_holder_name'] = $accountHolderName;
        $arguments['bank_account']['account_holder_type'] = $accountHolderType;
        $arguments['bank_account']['routing_number'] = $routingNumber;
        $arguments['bank_account']['account_number'] = $accountNumber;

        $this->stripe('create', $arguments, $key);

        return $this;
    }

    public function createPii($personalIdNumber, string $key = null): TokenInterface
    {
        $this->stripe('create', [
            'pii' => [
                'personal_id_number' => $personalIdNumber,
            ],
            ], $key);

        return $this;
    }

    public function createAccount(array $arguments = [], string $key = null): TokenInterface
    {
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    protected function stripe(string $method, $arguments, string $idempotencyKey = null): void
    {
        $this->response = \Stripe\Token::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
