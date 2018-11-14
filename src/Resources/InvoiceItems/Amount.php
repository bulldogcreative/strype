<?php

declare(strict_types=1);

namespace Bulldog\Strype\Resources\InvoiceItems;

use Bulldog\Strype\Contracts\Resources\InvoiceItemTypeInterface;

class Amount implements InvoiceItemTypeInterface
{
    protected $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function getType(): array
    {
        return [
            'amount' => $this->amount,
        ];
    }
}
