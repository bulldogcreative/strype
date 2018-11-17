<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Resources\EventInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;

/**
 * Event class.
 *
 * @see https://stripe.com/docs/api/events
 */
class Event extends Resource implements EventInterface, RetrieveInterface, ListAllInterface
{
    use Retrieve, ListAll;

    protected function stripe(string $method, $arguments): void
    {
        $this->response = \Stripe\Event::{$method}($arguments);
        $this->setProperties();
    }
}
