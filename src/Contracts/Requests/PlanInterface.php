<?php

namespace Bulldog\Strype\Contracts\Requests;

interface PlanInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function create(array $arguments, $key = null);
}
