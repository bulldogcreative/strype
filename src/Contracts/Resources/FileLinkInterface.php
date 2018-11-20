<?php

namespace Bulldog\Strype\Contracts\Resources;

use Bulldog\Strype\Contracts\ResourceInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;

interface FileLinkInterface extends ResourceInterface, RetrieveInterface, ListAllInterface, UpdateInterface
{
    public function create(string $id, array $arguments = [], string $key = null): FileLinkInterface;
}
