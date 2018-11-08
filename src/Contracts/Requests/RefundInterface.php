<?php

namespace Bulldog\Strype\Contracts\Requests;

interface RefundInterface
{
    public function create(ChargeInterface $charge, array $arguments = [], $key = null);
}
