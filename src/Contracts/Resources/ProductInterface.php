<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Resources;

use Bulldog\Strype\Contracts\Models\ProductTypeInterface;

interface ProductInterface extends \Bulldog\Strype\Contracts\ResourceInterface
{
    public function create(ProductTypeInterface $product, string $key = null): ProductInterface;
}