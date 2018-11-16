<?php

namespace Bulldog\Strype\Contracts\Requests;

interface PlanInterface extends \Bulldog\Strype\Contracts\ResourceInterface
{
    public function create(array $arguments, string $key = null): PlanInterface;
}
