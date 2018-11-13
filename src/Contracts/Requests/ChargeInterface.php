<?php

namespace Bulldog\Strype\Contracts\Requests;

/**
 * Interface CustomerInterface.
 */
interface ChargeInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function create(CustomerInterface $customer, int $amount, array $arguments = [], $key = null, string $currency = 'usd');

    public function capture(string $id);
}
