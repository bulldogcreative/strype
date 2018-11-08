<?php

namespace Bulldog\Strype\Contracts\Requests;

use Bulldog\Strype\Contracts\Resources\ProductTypeInterface;

interface ProductInterface
{
    public function create(ProductTypeInterface $product);
}
