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
 * A dispute occurs when a customer questions your charge with their card issuer.
 * When this happens, you're given the opportunity to respond to the dispute with
 * evidence that shows that the charge is legitimate. You can find more information
 * about the dispute process in our Disputes and Fraud documentation.
 *
 * @see https://stripe.com/docs/api/disputes
 */
class Dispute extends Resource implements DisputeInterface, RetrieveInterface, UpdateInterface, ListAllInterface
{
    use Retrieve, Update, ListAll;

    /**
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
