<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Requests;

interface FileLinkInterface
{
    public function create(string $id, $arguments = [], $key = null);
}
