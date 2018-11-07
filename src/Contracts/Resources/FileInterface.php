<?php

namespace Bulldog\Strype\Contracts\Resources;

interface FileInterface
{
    public function create(FilesInterface $file, $arguments = [], $key = null);
}
