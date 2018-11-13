<?php

namespace Bulldog\Strype\Contracts\Requests;

interface PlanInterface
{
    public function create(array $arguments, $key = null);
}
