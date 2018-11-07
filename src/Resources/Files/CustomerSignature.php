<?php

namespace Bulldog\Strype\Resources\Files;

use Bulldog\Strype\Contracts\Resources\FilesInterface;

class CustomerSignature implements FilesInterface
{
    protected $file;
    protected $purpose;

    public function __construct($file)
    {
        $this->file = $file;
        $this->purpose = 'customer_signature';
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
