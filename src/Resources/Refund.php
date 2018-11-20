<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Resources\ChargeInterface;
use Bulldog\Strype\Contracts\Resources\RefundInterface;

/**
 * Refund objects allow you to refund a charge that has previously been created
 * but not yet refunded. Funds will be refunded to the credit or debit card that
 * was originally charged.
 *
 * @see https://stripe.com/docs/api/refunds
 */
class Refund extends Resource implements RefundInterface, RetrieveInterface, ListAllInterface, UpdateInterface
{
    use Retrieve, Update, ListAll;

    /**
     * When you create a new refund, you must specify a charge on which to create it.
     *
     * Creating a new refund will refund a charge that has previously been created but not yet refunded. Funds will be
     * refunded to the credit or debit card that was originally charged.
     *
     * You can optionally refund only part of a charge. You can do so multiple times, until the entire charge has been
     * refunded.
     *
     * Once entirely refunded, a charge can’t be refunded again. This method will throw an error when called on an
     * already-refunded charge, or when trying to refund more money than is left on a charge.
     *
     * @see https://stripe.com/docs/api/refunds/create
     *
     * @param ChargeInterface $charge
     * @param array           $arguments
     * @param string          $key
     *
     * @return RefundInterface
     */
    public function create(ChargeInterface $charge, array $arguments = [], string $key = null): RefundInterface
    {
        $arguments['charge'] = $charge->getId();
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    protected function stripe(string $method, $arguments, string $idempotencyKey = null): void
    {
        $this->response = \Stripe\Refund::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
