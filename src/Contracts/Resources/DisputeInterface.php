<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Resources;

interface DisputeInterface extends \Bulldog\Strype\Contracts\ResourceInterface
{
    public function close(string $id): DisputeInterface;
}
