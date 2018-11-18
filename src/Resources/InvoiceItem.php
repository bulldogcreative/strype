<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Delete;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Traits\DeleteInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Resources\CustomerInterface;
use Bulldog\Strype\Contracts\Resources\InvoiceItemInterface;
use Bulldog\Strype\Contracts\Models\InvoiceItemTypeInterface;

/**
 * InvoiceItem class.
 *
 * Sometimes you want to add a charge or credit to a customer, but actually charge
 * or credit the customer's card only at the end of a regular billing cycle. This
 * is useful for combining several charges (to minimize per-transaction fees), or
 * for having Stripe tabulate your usage-based billing totals.
 *
 * @see https://stripe.com/docs/api/invoiceitems
 */
class InvoiceItem extends Resource implements InvoiceItemInterface, RetrieveInterface, UpdateInterface, ListAllInterface, DeleteInterface
{
    use Retrieve, Update, ListAll, Delete;

    public function create(CustomerInterface $customer, InvoiceItemTypeInterface $type, array $arguments = [], string $key = null, string $currency = 'usd'): InvoiceItemInterface
    {
        $arguments = array_merge($arguments, $type->toArray());
        $arguments['customer'] = $customer->getId();
        $arguments['currency'] = $currency;
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    protected function stripe(string $method, $arguments, string $idempotencyKey = null): void
    {
        $this->response = \Stripe\InvoiceItem::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
