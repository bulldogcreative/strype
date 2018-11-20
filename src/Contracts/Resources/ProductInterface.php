<?php

namespace Bulldog\Strype\Contracts\Resources;

use Bulldog\Strype\Contracts\ResourceInterface;
use Bulldog\Strype\Contracts\Traits\DeleteInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Models\ProductTypeInterface;

interface ProductInterface extends ResourceInterface, RetrieveInterface, ListAllInterface, UpdateInterface, DeleteInterface
{
    public function create(ProductTypeInterface $product, string $key = null): ProductInterface;
}
