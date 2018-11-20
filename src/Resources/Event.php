<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Resources\EventInterface;

/**
 * Events are our way of letting you know when something interesting happens in
 * your account. When an interesting event occurs, we create a new Event object.
 * For example, when a charge succeeds, we create a charge.succeeded event; and
 * when an invoice payment attempt fails, we create an invoice.payment_failed
 * event. Note that many API requests may cause multiple events to be created.
 * For example, if you create a new subscription for a customer, you will receive
 * both a customer.subscription.created event and a charge.succeeded event.
 *
 * @see https://stripe.com/docs/api/events
 */
class Event extends Resource implements EventInterface
{
    use Retrieve, ListAll;

    protected function stripe(string $method, $arguments): void
    {
        $this->response = \Stripe\Event::{$method}($arguments);
        $this->setProperties();
    }
}
