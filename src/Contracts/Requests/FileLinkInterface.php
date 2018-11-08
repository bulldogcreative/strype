<?php

namespace Bulldog\Strype\Contracts\Requests;

interface FileLinkInterface
{
    public function create(string $id, $arguments = [], $key = null);
}
