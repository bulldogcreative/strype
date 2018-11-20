<?php

namespace Bulldog\Strype\Contracts\Resources;

use Bulldog\Strype\Contracts\ResourceInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;

interface EventInterface extends ResourceInterface, RetrieveInterface, ListAllInterface
{
}
