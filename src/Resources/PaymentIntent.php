<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Resources\PaymentIntentInterface;

/**
 * @see https://stripe.com/docs/api/payment_intents
 */
class PaymentIntent extends Resource implements PaymentIntentInterface
{
    use Retrieve, Update;

    public function create(array $allowedSourceTypes, int $amount, array $arguments = [], string $key = null, string $currency = 'usd'): PaymentIntentInterface
    {
        $arguments['allowed_source_types'] = $allowedSourceTypes;
        $arguments['amount'] = $amount;
        $arguments['currency'] = $currency;

        $this->stripe('create', $arguments, $key);

        return $this;
    }

    public function confirm(string $id, array $arguments = []): PaymentIntentInterface
    {
        $this->stripe('retrieve', $id);
        $this->response->confirm($arguments);

        return $this;
    }

    public function capture(string $id, array $arguments = []): PaymentIntentInterface
    {
        $this->stripe('retrieve', $id);
        $this->response->capture($arguments);

        return $this;
    }

    public function cancel(string $id, array $arguments = []): PaymentIntentInterface
    {
        $this->stripe('retrieve', $id);
        $this->response->cancel($arguments);

        return $this;
    }

    protected function stripe(string $method, $arguments, string $idempotencyKey = null): void
    {
        $this->response = \Stripe\PaymentIntent::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
