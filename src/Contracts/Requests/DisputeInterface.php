<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Requests;

interface DisputeInterface
{
    public function close(string $id);
}
