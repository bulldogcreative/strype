<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Requests;

interface FileLinkInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function create(string $id, $arguments = [], $key = null);
}
