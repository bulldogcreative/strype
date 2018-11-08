<?php

namespace Bulldog\Strype\Contracts\Requests;

interface DisputeInterface
{
    public function close(string $id);
}
