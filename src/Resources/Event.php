<?php

declare(strict_types=1);

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Contracts\Requests\EventInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Request;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;

class Event extends Request implements EventInterface, RetrieveInterface, ListAllInterface
{
    use Retrieve, ListAll;

    protected function stripe(string $method, $arguments): void
    {
        $this->response = \Stripe\Event::{$method}($arguments);
        $this->setProperties();
    }
}