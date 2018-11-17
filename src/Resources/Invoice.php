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
use Bulldog\Strype\Contracts\Resources\InvoiceInterface;
use Bulldog\Strype\Contracts\Resources\CustomerInterface;
use Bulldog\Strype\Contracts\Models\SubscriptionBillingTypeInterface;

/**
 * Invoice class.
 *
 * @see https://stripe.com/docs/api/invoices
 */
class Invoice extends Resource implements InvoiceInterface, RetrieveInterface, UpdateInterface, ListAllInterface, DeleteInterface
{
    use Retrieve, Update, ListAll, Delete;

    /**
     * Create an invoice.
     *
     * This endpoint creates a draft invoice for a given customer. The draft invoice created pulls in all pending invoice
     * items on that customer, including prorations.
     *
     * @see https://stripe.com/docs/api/invoices/create
     *
     * @param CustomerInterface                $customer
     * @param SubscriptionBillingTypeInterface $type
     * @param array                            $arguments
     * @param string|null                      $key
     *
     * @return InvoiceInterface
     */
    public function create(CustomerInterface $customer, SubscriptionBillingTypeInterface $type, array $arguments = [], ?string $key = null): InvoiceInterface
    {
        $arguments = array_merge($arguments, $type->toArray());
        $arguments['customer'] = $customer->getId();
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    public function finalizeInvoice(string $invoiceid): InvoiceInterface
    {
        $this->stripe('retrieve', $invoiceid);
        $this->response = $this->response->finalizeInvoice();
        $this->setProperties();

        return $this;
    }

    public function pay(string $invoiceid): InvoiceInterface
    {
        $this->stripe('retrieve', $invoiceid);
        $this->response = $this->response->pay();
        $this->setProperties();

        return $this;
    }

    public function sendInvoice(string $invoiceid): InvoiceInterface
    {
        $this->stripe('retrieve', $invoiceid);
        $this->response = $this->response->sendInvoice();
        $this->setProperties();

        return $this;
    }

    public function voidInvoice(string $invoiceid): InvoiceInterface
    {
        $this->stripe('retrieve', $invoiceid);
        $this->response = $this->response->voidInvoice();
        $this->setProperties();

        return $this;
    }

    public function markUncollectible(string $invoiceid): InvoiceInterface
    {
        $this->stripe('retrieve', $invoiceid);
        $this->response = $this->response->markUncollectible();
        $this->setProperties();

        return $this;
    }

    public function retrieveLineItems(string $invoiceid, array $arguments = []): InvoiceInterface
    {
        $this->stripe('retrieve', $invoiceid);
        $this->response = $this->lines = $this->response->lines->all($arguments);
        $this->setProperties();

        return $this;
    }

    public function upcoming(CustomerInterface $customer, array $arguments = []): InvoiceInterface
    {
        $arguments['customer'] = $customer->getId();
        $this->response = $this->stripe('upcoming', $arguments);

        return $this;
    }

    public function retrieveUpcomingLineItems(CustomerInterface $customer, array $arguments = []): InvoiceInterface
    {
        $this->response = \Stripe\Invoice::upcoming(['customer' => $customer->getId()])->lines->all($arguments);
        $this->setProperties();

        return $this;
    }

    protected function stripe(string $method, $arguments, string $idempotencyKey = null): void
    {
        $this->response = \Stripe\Invoice::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
