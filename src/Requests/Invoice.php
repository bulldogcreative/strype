<?php

namespace Bulldog\Strype\Requests;

use Bulldog\Strype\Request;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Delete;
use Bulldog\Strype\Contracts\Requests\CustomerInterface;
use Bulldog\Strype\Contracts\Requests\InvoiceInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\DeleteInterface;
use Bulldog\Strype\Contracts\Resources\SubscriptionBillingInterface;

class Invoice extends Request implements InvoiceInterface, RetrieveInterface, UpdateInterface, ListAllInterface, DeleteInterface
{
    use Retrieve, Update, ListAll, Delete;

    public function create(CustomerInterface $customer, SubscriptionBillingInterface $type, array $arguments = [], string $key = null)
    {
        $arguments = array_merge($arguments, $type->getBilling());
        $arguments['customer'] = $customer->getCustomerId();
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    public function finalizeInvoice(string $invoiceid)
    {
        $this->stripe('retrieve', $invoiceid);
        $this->response->finalizeInvoice();

        return $this;
    }

    public function pay(string $invoiceid)
    {
        $this->stripe('retrieve', $invoiceid);
        $this->response->pay();

        return $this;
    }

    public function sendInvoice(string $invoiceid)
    {
        $this->stripe('retrieve', $invoiceid);
        $this->response->sendInvoice();

        return $this;
    }

    public function voidInvoice(string $invoiceid)
    {
        $this->stripe('retrieve', $invoiceid);
        $this->response->voidInvoice();

        return $this;
    }

    public function markUncollectable(string $invoiceid)
    {
        $this->stripe('retrieve', $invoiceid);
        $this->response->markUncollectable();

        return $this;
    }

    public function retrieveLineItems(string $invoiceid, array $arguments = [])
    {
        $this->stripe('retrieve', $invoiceid);
        $this->lines = $this->response->lines($arguments);

        return $this;
    }

    public function upcoming(CustomerInterface $customer, array $arguments = [])
    {
        $arguments['customer'] = $customer->getCustomerId();
        $this->stripe('upcoming', $arguments);

        return $this;
    }

    public function retrieveUpcomingLineItems(CustomerInterface $customer, array $arguments = [])
    {
        $arguments['customer'] = $customer->getCustomerId();
        $this->response = \Stripe\Invoice::retrieve('upcoming')->lines->all($arguments);
        $this->setProperties();

        return $this;
    }

    protected function stripe(string $method, $arguments, $idempotencyKey = null)
    {
        $this->response = \Stripe\Invoice::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}