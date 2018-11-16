<?php

namespace Bulldog\Strype\Contracts\Resources;

interface PlanInterface extends \Bulldog\Strype\Contracts\ResourceInterface
{
    public function create(array $arguments, string $key = null): PlanInterface;
}
