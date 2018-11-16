<?php



namespace Bulldog\Strype\Contracts\Resources;

use Bulldog\Strype\Contracts\Models\InvoiceItemTypeInterface;

interface InvoiceItemInterface extends \Bulldog\Strype\Contracts\ResourceInterface
{
    public function create(CustomerInterface $customer, InvoiceItemTypeInterface $type, array $arguments = [], string $key = null, string $currency = 'usd'): InvoiceItemInterface;
}
