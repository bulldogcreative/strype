<?php

namespace Bulldog\Strype\Contracts\Resources;

use Bulldog\Strype\Contracts\ResourceInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;

/**
 * Interface CustomerInterface.
 */
interface ChargeInterface extends ResourceInterface, RetrieveInterface, UpdateInterface, ListAllInterface
{
    public function create(CustomerInterface $customer, int $amount, array $arguments = [], string $key = null, string $currency = 'usd'): ChargeInterface;

    public function capture(string $id): ChargeInterface;
}
