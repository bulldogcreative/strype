<?php

namespace Bulldog\Strype\Contracts\Resources;

interface ProductInterface
{
    public function create(ProductTypeInterface $product);
}
