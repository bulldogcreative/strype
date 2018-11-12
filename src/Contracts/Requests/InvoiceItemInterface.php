<?php

namespace Bulldog\Strype\Contracts\Requests;

interface InvoiceItemInterface
{
    public function create(CustomerInterface $customer, array $arguments = [], $key = null, string $currency = 'usd');
}
