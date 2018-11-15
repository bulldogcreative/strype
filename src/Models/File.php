<?php

namespace Bulldog\Strype\Models;

use Bulldog\Strype\Contracts\Models\FileTypeInterface;

abstract class File implements FileTypeInterface
{
    protected $file;
    protected $purpose;

    public function getFile()
    {
        return $this->file;
    }

    public function getPurpose(): string
    {
        return $this->purpose;
    }
}
