<?php

declare(strict_types=1);

namespace Bulldog\Strype\Requests;

use Bulldog\Strype\Request;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Requests\TokenInterface;

class Token extends Request implements TokenInterface, RetrieveInterface
{
    use Retrieve;

    public function createCard($number, int $expMonth, int $expYear, int $cvc, $arguments = [], $key = null)
    {
        $arguments['card']['number'] = $number;
        $arguments['card']['exp_month'] = $expMonth;
        $arguments['card']['exp_year'] = $expYear;
        $arguments['card']['cvc'] = $cvc;

        $this->stripe('create', $arguments, $key);

        return $this;
    }

    public function createBankAccount($country, $currency, string $accountHolderName, $accountHolderType, $routingNumber, $accountNumber, $arguments = [], $key = null)
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

    public function createPii($personalIdNumber, $key = null)
    {
        $this->stripe('create', [
            'pii' => [
                'personal_id_number' => $personalIdNumber,
            ],
            ], $key);

        return $this;
    }

    public function createAccount($arguments = [], $key = null)
    {
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    protected function stripe(string $method, $arguments, $idempotencyKey = null) : void
    {
        $this->response = \Stripe\Token::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
