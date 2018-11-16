<?php



namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Contracts\Requests\DisputeInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Traits\Update;

class Dispute extends Resource implements DisputeInterface, RetrieveInterface, UpdateInterface, ListAllInterface
{
    use Retrieve, Update, ListAll;

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
