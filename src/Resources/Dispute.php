<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Resources\DisputeInterface;

/**
 * Dispute class.
 *
 * @see https://stripe.com/docs/api/disputes
 */
class Dispute extends Resource implements DisputeInterface, RetrieveInterface, UpdateInterface, ListAllInterface
{
    use Retrieve, Update, ListAll;

    /**
     * Close a dispute.
     *
     * Closing the dispute for a charge indicates that you do not have any evidence to submit and are essentially
     * dismissing the dispute, acknowledging it as lost.
     *
     * @see https://stripe.com/docs/api/disputes/close
     *
     * @param string $id
     *
     * @return DisputeInterface
     */
    public function close(string $id): DisputeInterface
    {
        $this->stripe('retrieve', $id);
        $this->response->close();

        return $this;
    }

    protected function stripe(string $method, $arguments): void
    {
        $this->response = \Stripe\Dispute::{$method}($arguments);
        $this->setProperties();
    }
}
