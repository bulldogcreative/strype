<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\Delete;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\DeleteInterface;
use Bulldog\Strype\Contracts\Resources\ProductInterface;
use Bulldog\Strype\Contracts\Resources\ProductTypeInterface;

class Product extends Resource implements ProductInterface, RetrieveInterface, ListAllInterface, UpdateInterface, DeleteInterface
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
