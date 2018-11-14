<?php

declare(strict_types=1);

namespace Bulldog\Strype\Requests;

use Bulldog\Strype\Request;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Requests\EventInterface;

class Event extends Request implements EventInterface, RetrieveInterface, ListAllInterface
{
    use Retrieve, ListAll;

    protected function stripe(string $method, $arguments)
    {
        $this->response = \Stripe\Event::{$method}($arguments);
        $this->setProperties();
    }
}
