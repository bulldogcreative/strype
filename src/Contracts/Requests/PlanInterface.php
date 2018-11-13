<?php

namespace Bulldog\Strype\Contracts\Requests;

interface PlanInterface
{
    public function create($arguments = [], $key = null);
}
