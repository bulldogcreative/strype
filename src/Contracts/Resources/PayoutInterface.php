<?php



namespace Bulldog\Strype\Contracts\Resources;

interface PayoutInterface extends \Bulldog\Strype\Contracts\ResourceInterface
{
    public function create(int $amount, array $arguments = [], string $key = null, string $currency = 'usd'): PayoutInterface;

    public function cancel(string $id): PayoutInterface;
}
