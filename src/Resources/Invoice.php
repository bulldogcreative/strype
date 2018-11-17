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
     * This endpoint creates a draft invoice for a given customer. The draft
     * invoice created pulls in all pending invoice items on that customer,
     * including prorations.
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

    /**
     * Finalize an invoice.
     *
     * Stripe automatically finalizes drafts before sending and attempting payment
     * on invoices. However, if you’d like to finalize a draft invoice manually,
     * you can do so using this method.
     *
     * @see https://stripe.com/docs/api/invoices/finalize
     *
     * @param string $invoiceid
     *
     * @return InvoiceInterface
     */
    public function finalizeInvoice(string $invoiceid): InvoiceInterface
    {
        $this->stripe('retrieve', $invoiceid);
        $this->response = $this->response->finalizeInvoice();
        $this->setProperties();

        return $this;
    }

    /**
     * Pay an invoice.
     *
     * Stripe automatically creates and then attempts to collect payment on
     * invoices for customers on subscriptions according to your subscriptions
     * settings. However, if you’d like to attempt payment on an invoice out of
     * the normal collection schedule or for some other reason, you can do so.
     *
     * @see https://stripe.com/docs/api/invoices/pay
     *
     * @param string $invoiceid
     *
     * @return InvoiceInterface
     */
    public function pay(string $invoiceid): InvoiceInterface
    {
        $this->stripe('retrieve', $invoiceid);
        $this->response = $this->response->pay();
        $this->setProperties();

        return $this;
    }

    /**
     * Send an invoice for manual payment.
     *
     * Stripe will automatically send invoices to customers according to your
     * subscriptions settings. However, if you’d like to manually send an invoice
     * to your customer out of the normal schedule, you can do so. When sending
     * invoices that have already been paid, there will be no reference to the
     * payment in the email.
     *
     * @see https://stripe.com/docs/api/invoices/send
     *
     * @param string $invoiceid
     *
     * @return InvoiceInterface
     */
    public function sendInvoice(string $invoiceid): InvoiceInterface
    {
        $this->stripe('retrieve', $invoiceid);
        $this->response = $this->response->sendInvoice();
        $this->setProperties();

        return $this;
    }

    /**
     * Void an invoice.
     *
     * Mark a finalized invoice as void. This cannot be undone. Voiding an invoice
     * is similar to deletion, however it only applies to finalized invoices and
     * maintains a papertrail where the invoice can still be found.
     *
     * @see https://stripe.com/docs/api/invoices/void
     *
     * @param string $invoiceid
     *
     * @return InvoiceInterface
     */
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
