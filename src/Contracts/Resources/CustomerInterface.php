<?php

namespace Bulldog\Strype\Contracts\Resources;

use Bulldog\Strype\Contracts\ResourceInterface;
use Bulldog\Strype\Contracts\Traits\DeleteInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;

interface CustomerInterface extends ResourceInterface, RetrieveInterface, UpdateInterface, DeleteInterface, ListAllInterface
{
    public function create(string $email, string $token, array $arguments = [], string $key = null): CustomerInterface;
}
