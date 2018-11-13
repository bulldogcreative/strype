<?php

namespace Bulldog\Strype\Contracts\Requests;

use Bulldog\Strype\Contracts\Resources\ProductTypeInterface;

interface ProductInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function create(ProductTypeInterface $product);
}
