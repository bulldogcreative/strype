<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Resources;

interface InvoiceItemTypeInterface
{
    public function getType(): array;
}
