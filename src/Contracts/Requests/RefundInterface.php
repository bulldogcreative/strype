<?php

namespace Bulldog\Strype\Contracts\Requests;

interface RefundInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function create(ChargeInterface $charge, array $arguments = [], $key = null);
}
