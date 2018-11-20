<?php

namespace Bulldog\Strype\Contracts\Resources;

use Bulldog\Strype\Contracts\ResourceInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;

interface RefundInterface extends ResourceInterface, RetrieveInterface, ListAllInterface, UpdateInterface
{
    public function create(ChargeInterface $charge, array $arguments = [], string $key = null): RefundInterface;
}
