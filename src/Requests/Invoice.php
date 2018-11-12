<?php

namespace Bulldog\Strype\Requests;

use Bulldog\Strype\Request;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Contracts\Requests\CustomerInterface;
use Bulldog\Strype\Contracts\Requests\InvoiceInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Resources\SubscriptionBillingInterface;

class Invoice extends Request implements InvoiceInterface, RetrieveInterface, UpdateInterface, ListAllInterface
{
    public function create(CustomerInterface $customer, SubscriptionBillingInterface $type, array $arguments = [], ?string $key)
    {

    }

    public function finalize(string $invoiceid)
    {

    }

    public function pay(string $invoiceid)
    {

    }

    public function sendInvoice(string $invoiceid)
    {

    }

    public function voidInvoice(string $invoiceid)
    {

    }

    public function markUncollectable(string $invoiceid)
    {

    }

    public function retrieveLineItems(string $invoiceid, array $arguments = [])
    {

    }

    public function upcoming(CustomerInterface $customer, array $arguments = [])
    {

    }

    public function retrieveUpcomingLineItems(CustomerInterface $customer, array $arguments = [])
    {

    }

    protected function stripe(string $method, $arguments, $idempotencyKey = null)
    {
        $this->response = \Stripe\Invoice::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}