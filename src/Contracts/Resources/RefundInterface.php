<?php

namespace Bulldog\Strype\Contracts\Resources;

interface RefundInterface
{
    public function create(ChargeInterface $charge, array $arguments = [], $key = null);
}
