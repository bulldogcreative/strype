<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Resources;

use Bulldog\Strype\Contracts\Models\FileTypeInterface;

interface FileInterface extends \Bulldog\Strype\Contracts\ResourceInterface
{
    public function create(FileTypeInterface $file, array $arguments = [], $key = null): FileInterface;
}
