<?php

namespace Bulldog\Strype\Models\InvoiceItems;

use Bulldog\Strype\Contracts\Models\InvoiceItemTypeInterface;

/**
 * Invoice Item Quantity.
 */
class Quantity implements InvoiceItemTypeInterface
{
    protected $quantity;
    protected $unitAmount;

    public function __construct(int $quantity, int $unitAmount)
    {
        $this->quantity = $quantity;
        $this->unitAmount = $unitAmount;
    }

    public function toArray(): array
    {
        return [
            'quantity' => $this->quantity,
            'unit_amount' => $this->unitAmount,
        ];
    }
}
