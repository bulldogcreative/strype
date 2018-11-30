<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Resources\PaymentIntentInterface;

/**
 * A PaymentIntent tracks the process of collecting a payment from your customer.
 * We recommend that you create exactly one PaymentIntent for each order or customer
 * session in your system. You can reference the PaymentIntent later to see the
 * history of payment attempts for a particular session.
 *
 * @see https://stripe.com/docs/api/payment_intents
 */
class PaymentIntent extends Resource implements PaymentIntentInterface
{
    use Retrieve, Update, ListAll;

    /**
     * Creates a PaymentIntent object.
     *
     * @see https://stripe.com/docs/api/payment_intents/create
     *
     * @param array  $allowedSourceTypes
     * @param int    $amount
     * @param array  $arguments
     * @param string $key
     * @param string $currency
     *
     * @return PaymentIntentInterface
     */
    public function create(array $allowedSourceTypes, int $amount, array $arguments = [], string $key = null, string $currency = 'usd'): PaymentIntentInterface
    {
        $arguments['allowed_source_types'] = $allowedSourceTypes;
        $arguments['amount'] = $amount;
        $arguments['currency'] = $currency;

        $this->stripe('create', $arguments, $key);

        return $this;
    }

    /**
     * Confirm that your customer intends to pay with current or provided source.
     * Upon confirmation, the PaymentIntent will attempt to initiate a payment.
     *
     * @see https://stripe.com/docs/api/payment_intents/confirm
     *
     * @param string $id
     * @param array  $arguments
     *
     * @return PaymentIntentInterface
     */
    public function confirm(string $id, array $arguments = []): PaymentIntentInterface
    {
        $this->stripe('retrieve', $id);
        $this->response->confirm($arguments);

        return $this;
    }

    /**
     * Capture the funds of an existing uncaptured PaymentIntent where
     * required_action="requires_capture".
     *
     * @see https://stripe.com/docs/api/payment_intents/capture
     *
     * @param string $id
     * @param array  $arguments
     *
     * @return PaymentIntentInterface
     */
    public function capture(string $id, array $arguments = []): PaymentIntentInterface
    {
        $this->stripe('retrieve', $id);
        $this->response->capture($arguments);

        return $this;
    }

    /**
     * A PaymentIntent object can be canceled when it is in one of these statues:
     * requires_source, requires_capture, requires_confirmation, or
     * requires_source_action.
     *
     * @see https://stripe.com/docs/api/payment_intents/cancel
     *
     * @param string $id
     * @param array  $arguments
     *
     * @return PaymentIntentInterface
     */
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
