<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Requests;

use Bulldog\Strype\Contracts\Models\ProductTypeInterface;

interface ProductInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function create(ProductTypeInterface $product, string $key = null): ProductInterface;
}
