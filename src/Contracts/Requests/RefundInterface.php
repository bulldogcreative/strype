<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Requests;

interface RefundInterface
{
    public function create(ChargeInterface $charge, array $arguments = [], $key = null);
}
