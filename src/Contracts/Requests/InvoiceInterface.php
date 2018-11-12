<?php

namespace Bulldog\Strype\Contracts\Requests;

use Bulldog\Strype\Contracts\Resources\SubscriptionBillingInterface;

interface InvoiceInterface
{
    public function create(CustomerInterface $customer, SubscriptionBillingInterface $type, array $arguments = [], string $key = null);

    public function finalize(string $invoiceid);

    public function pay(string $invoiceid);

    public function sendInvoice(string $invoiceid);

    public function voidInvoice(string $invoiceid);

    public function markUncollectable(string $invoiceid);

    public function retrieveLineItems(string $invoiceid, array $arguments = []);

    public function upcoming(CustomerInterface $customer, array $arguments = []);

    public function retrieveUpcomingLineItems(CustomerInterface $customer, array $arguments = []);
}
