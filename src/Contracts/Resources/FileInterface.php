<?php

namespace Bulldog\Strype\Contracts\Resources;

use Bulldog\Strype\Contracts\ResourceInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Models\FileTypeInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;

interface FileInterface extends ResourceInterface, RetrieveInterface, ListAllInterface
{
    public function create(FileTypeInterface $file, array $arguments = [], string $key = null): FileInterface;
}
