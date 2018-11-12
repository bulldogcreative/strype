<?php

namespace Bulldog\Strype\Contracts\Requests;

use Bulldog\Strype\Contracts\Resources\InvoiceItemTypeInterface;

interface InvoiceItemInterface
{
    public function create(CustomerInterface $customer, InvoiceItemTypeInterface $type, array $arguments = [], $key = null, string $currency = 'usd');
}
