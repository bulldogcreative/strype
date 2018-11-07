<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Resources\EventInterface;

class Event extends Resource implements EventInterface, RetrieveInterface, ListAllInterface
{
    use Retrieve, ListAll;

    protected function stripe(string $method, $arguments)
    {
        $this->response = \Stripe\Event::{$method}($arguments);
        $this->setProperties();
    }
}
