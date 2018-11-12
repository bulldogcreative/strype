<?php

namespace Bulldog\Strype\Requests;

use Bulldog\Strype\Request;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\Delete;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\DeleteInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Requests\InvoiceItemInterface;
use Bulldog\Strype\Contracts\Requests\CustomerInterface;

class InvoiceItem extends Request implements InvoiceItemInterface, RetrieveInterface, UpdateInterface, ListAllInterface, DeleteInterface
{
    use Retrieve, Update, ListAll, Delete;

    public function create(CustomerInterface $customer, array $arguments = [], $key = null, string $currency = 'usd')
    {
        $arguments['customer'] = $customer->getCustomerId();
        $arguments['currency'] = $currency;
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    protected function stripe(string $method, $arguments, $idempotencyKey = null)
    {
        $this->response = \Stripe\InvoiceItem::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
