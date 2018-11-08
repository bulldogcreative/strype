<?php

namespace Bulldog\Strype\Contracts\Requests;

interface PayoutInterface
{
    public function create(int $amount, $arguments = [], $key = null, $currency = 'usd');

    public function cancel(string $id);
}
