<?php

namespace Bulldog\Strype\Contracts\Resources;

use Bulldog\Strype\Contracts\ResourceInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;

interface PayoutInterface extends ResourceInterface, RetrieveInterface, ListAllInterface, UpdateInterface
{
    public function create(int $amount, array $arguments = [], string $key = null, string $currency = 'usd'): PayoutInterface;

    public function cancel(string $id): PayoutInterface;
}
