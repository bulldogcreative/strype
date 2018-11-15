<?php

namespace Bulldog\Strype\Models;

use Bulldog\Strype\Contracts\Models\FileInterface;

class File implements FileInterface
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
