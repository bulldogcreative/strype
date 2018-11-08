<?php

namespace Bulldog\Strype\Requests;

use Bulldog\Strype\Request;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\Delete;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\DeleteInterface;
use Bulldog\Strype\Contracts\Requests\ProductInterface;
use Bulldog\Strype\Contracts\Resources\ProductTypeInterface;

class Product extends Request implements ProductInterface, RetrieveInterface, ListAllInterface, UpdateInterface, DeleteInterface
{
    use Retrieve, Update, ListAll, Delete;

    public function create(ProductTypeInterface $product, $key = null)
    {
        $this->stripe('create', $product->getArguments(), $key);

        return $this;
    }

    protected function stripe(string $method, $arguments, $idempotencyKey = null)
    {
        $this->response = \Stripe\Product::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
