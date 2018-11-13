<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Requests;

use Bulldog\Strype\Contracts\Resources\InvoiceItemTypeInterface;

interface InvoiceItemInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function create(CustomerInterface $customer, InvoiceItemTypeInterface $type, array $arguments = [], $key = null, string $currency = 'usd');
}
