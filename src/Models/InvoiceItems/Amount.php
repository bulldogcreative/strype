<?php

namespace Bulldog\Strype\Models\InvoiceItems;

use Bulldog\Strype\Contracts\Models\InvoiceItemTypeInterface;

class Amount implements InvoiceItemTypeInterface
{
    protected $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function toArray(): array
    {
        return [
            'amount' => $this->amount,
        ];
    }
}
