<?php

namespace Bulldog\Strype\Contracts\Requests;

interface FileLinkInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function create(string $id, $arguments = [], $key = null);
}
