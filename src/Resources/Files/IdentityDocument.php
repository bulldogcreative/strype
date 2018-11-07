<?php

namespace Bulldog\Strype\Resources\Files;

use Bulldog\Strype\Contracts\Resources\FilesInterface;

class IdentityDocument implements FilesInterface
{
    protected $file;
    protected $purpose;

    public function __construct($file)
    {
        $this->file = $file;
        $this->purpose = 'identity_document';
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getPurpose()
    {
        return $this->purpose;
    }
}
