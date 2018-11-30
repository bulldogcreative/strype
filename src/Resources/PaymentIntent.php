<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Contracts\Resources\PaymentIntentInterface;

/**
 * @see https://stripe.com/docs/api/payment_intents
 */
class PaymentIntent extends Resource implements PaymentIntentInterface
{
    public function create(array $allowedSourceTypes, int $amount, array $arguments = [], string $key = null, string $currency = 'usd'): PaymentIntentInterface
    {

    }

    public function confirm(string $id): PaymentIntentInterface
    {

    }

    public function capture(string $id): PaymentIntentInterface
    {

    }

    public function cancel(string $id): PaymentIntentInterface
    {

    }

    protected function stripe(string $method, $arguments, string $idempotencyKey = null): void
    {
        $this->response = \Stripe\PaymentIntent::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
