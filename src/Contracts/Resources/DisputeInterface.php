<?php

namespace Bulldog\Strype\Contracts\Resources;

interface DisputeInterface extends \Bulldog\Strype\Contracts\ResourceInterface
{
    public function close(string $id): DisputeInterface;
}
