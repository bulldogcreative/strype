<?php

namespace Bulldog\Strype\Resources\InvoiceItems;

use Bulldog\Strype\Contracts\Resources\InvoiceItemTypeInterface;

class Quantity implements InvoiceItemTypeInterface
{
    protected $quantity;
    protected $unitAmount;

    public function __construct(int $quantity, int $unitAmount)
    {
        $this->quantity = $quantity;
        $this->unitAmount = $unitAmount;
    }

    public function getType(): array
    {
        return [
            'quantity' => $this->quantity,
            'unit_amount' => $this->unitAmount,
        ];
    }
}
