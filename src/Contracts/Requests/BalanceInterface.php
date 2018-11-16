<?php

namespace Bulldog\Strype\Contracts\Requests;

interface BalanceInterface extends \Bulldog\Strype\Contracts\ResourceInterface
{
    public function retrieveBalance(): BalanceInterface;
}
