<?php



namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Contracts\Requests\ChargeInterface;
use Bulldog\Strype\Contracts\Requests\CustomerInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Traits\Update;

class Charge extends Resource implements ChargeInterface, RetrieveInterface, UpdateInterface, ListAllInterface
{
    use Retrieve, Update, ListAll;

    public function create(CustomerInterface $customer, int $amount, array $arguments = [], string $key = null, string $currency = 'usd'): ChargeInterface
    {
        $arguments['customer'] = $customer->getId();
        $arguments['amount'] = $amount;
        $arguments['currency'] = $currency;
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    public function capture(string $id = null): ChargeInterface
    {
        if (!is_null($id)) {
            $this->stripe('retrieve', $id);
            $this->response->capture();

            return $this;
        }

        $this->response->capture();

        return $this;
    }

    protected function stripe(string $method, $arguments, string $idempotencyKey = null): void
    {
        $this->response = \Stripe\Charge::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
