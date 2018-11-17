<?php

namespace Bulldog\Strype\Contracts\Resources;

interface BalanceInterface extends \Bulldog\Strype\Contracts\ResourceInterface
{
    public function retrieveBalanceTransaction(string $id): BalanceInterface;
}
