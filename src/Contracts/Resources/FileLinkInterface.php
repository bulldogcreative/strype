<?php

namespace Bulldog\Strype\Contracts\Resources;

interface FileLinkInterface
{
    public function create(string $id, $arguments = [], $key = null);
}
