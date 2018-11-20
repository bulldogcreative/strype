<?php

namespace Bulldog\Strype\Contracts\Resources;

use Bulldog\Strype\Contracts\ResourceInterface;
use Bulldog\Strype\Contracts\Traits\DeleteInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Models\InvoiceItemTypeInterface;

interface InvoiceItemInterface extends ResourceInterface, RetrieveInterface, UpdateInterface, ListAllInterface, DeleteInterface
{
    public function create(CustomerInterface $customer, InvoiceItemTypeInterface $type, array $arguments = [], string $key = null, string $currency = 'usd'): InvoiceItemInterface;
}
