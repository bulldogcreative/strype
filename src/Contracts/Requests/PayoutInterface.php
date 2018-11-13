<?php

namespace Bulldog\Strype\Contracts\Requests;

interface PayoutInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function create(int $amount, $arguments = [], $key = null, $currency = 'usd');

    public function cancel(string $id);
}
