<?php

namespace Bulldog\Strype\Contracts\Requests;

interface DisputeInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function close(string $id);
}
