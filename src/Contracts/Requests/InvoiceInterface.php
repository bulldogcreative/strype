<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Requests;

use Bulldog\Strype\Contracts\Resources\SubscriptionBillingInterface;

interface InvoiceInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function create(CustomerInterface $customer, SubscriptionBillingInterface $type, array $arguments = [], ?string $key = null): InvoiceInterface;

    public function finalizeInvoice(string $invoiceid): InvoiceInterface;

    public function pay(string $invoiceid): InvoiceInterface;

    public function sendInvoice(string $invoiceid): InvoiceInterface;

    public function voidInvoice(string $invoiceid): InvoiceInterface;

    public function markUncollectible(string $invoiceid): InvoiceInterface;

    public function retrieveLineItems(string $invoiceid, array $arguments = []): InvoiceInterface;

    public function upcoming(CustomerInterface $customer, array $arguments = []): InvoiceInterface;

    public function retrieveUpcomingLineItems(CustomerInterface $customer, array $arguments = []): InvoiceInterface;
}
