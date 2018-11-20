<?php

namespace Bulldog\Strype\Contracts\Resources;

use Bulldog\Strype\Contracts\ResourceInterface;
use Bulldog\Strype\Contracts\Traits\DeleteInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Models\SubscriptionBillingTypeInterface;

interface InvoiceInterface extends ResourceInterface, RetrieveInterface, UpdateInterface, ListAllInterface, DeleteInterface
{
    public function create(CustomerInterface $customer, SubscriptionBillingTypeInterface $type, array $arguments = [], ?string $key = null): InvoiceInterface;

    public function finalizeInvoice(string $invoiceid): InvoiceInterface;

    public function pay(string $invoiceid): InvoiceInterface;

    public function sendInvoice(string $invoiceid): InvoiceInterface;

    public function voidInvoice(string $invoiceid): InvoiceInterface;

    public function markUncollectible(string $invoiceid): InvoiceInterface;

    public function retrieveLineItems(string $invoiceid, array $arguments = []): InvoiceInterface;

    public function upcoming(CustomerInterface $customer, array $arguments = []): InvoiceInterface;

    public function retrieveUpcomingLineItems(CustomerInterface $customer, array $arguments = []): InvoiceInterface;
}
