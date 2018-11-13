<?php

namespace Bulldog\Strype\Contracts\Requests;

interface BalanceInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function retrieveBalance();
}
