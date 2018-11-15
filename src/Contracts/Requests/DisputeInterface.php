<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Requests;

interface DisputeInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function close(string $id): DisputeInterface;
}
