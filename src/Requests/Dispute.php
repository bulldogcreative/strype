<?php

declare(strict_types=1);

namespace Bulldog\Strype\Requests;

use Bulldog\Strype\Request;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Requests\DisputeInterface;

class Dispute extends Request implements DisputeInterface, RetrieveInterface, UpdateInterface, ListAllInterface
{
    use Retrieve, Update, ListAll;

    public function close(string $id)
    {
        $this->stripe('retrieve', $id);
        $this->response->close();

        return $this;
    }

    protected function stripe(string $method, $arguments)
    {
        $this->response = \Stripe\Dispute::{$method}($arguments);
        $this->setProperties();
    }
}
