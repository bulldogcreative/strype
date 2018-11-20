<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Delete;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Resources\ProductInterface;
use Bulldog\Strype\Contracts\Models\ProductTypeInterface;

/**
 * Product objects describe items that your customers can subscribe to with a
 * Subscription. An associated Plan determines the product pricing.
 *
 * @see https://stripe.com/docs/api/service_products
 */
class Product extends Resource implements ProductInterface
{
    use Retrieve, Update, ListAll, Delete;

    /**
     * Creates a new product object. To create a product for use with orders, see Products.
     *
     * @param ProductTypeInterface $product
     * @param string               $key
     *
     * @return ProductInterface
     */
    public function create(ProductTypeInterface $product, string $key = null): ProductInterface
    {
        $this->stripe('create', $product->toArray(), $key);

        return $this;
    }

    protected function stripe(string $method, $arguments, string $idempotencyKey = null): void
    {
        $this->response = \Stripe\Product::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
