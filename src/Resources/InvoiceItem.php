<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Delete;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Resources\CustomerInterface;
use Bulldog\Strype\Contracts\Resources\InvoiceItemInterface;
use Bulldog\Strype\Contracts\Models\InvoiceItemTypeInterface;

/**
 * Sometimes you want to add a charge or credit to a customer, but actually charge
 * or credit the customer's card only at the end of a regular billing cycle. This
 * is useful for combining several charges (to minimize per-transaction fees), or
 * for having Stripe tabulate your usage-based billing totals.
 *
 * @see https://stripe.com/docs/api/invoiceitems
 */
class InvoiceItem extends Resource implements InvoiceItemInterface
{
    use Retrieve, Update, ListAll, Delete;

    /**
     * Creates an item to be added to a draft invoice. If no invoice is specified,
     * the item will be on the next invoice created for the customer specified.
     *
     * @param CustomerInterface        $customer
     * @param InvoiceItemTypeInterface $type
     * @param array                    $arguments
     * @param string                   $key
     * @param string                   $currency
     *
     * @return InvoiceItemInterface
     */
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
