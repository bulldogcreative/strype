<?php

namespace Bulldog\Strype\Resources\Files;

use Bulldog\Strype\Contracts\Resources\FilesInterface;

class PciDocument implements FilesInterface
{
    protected $file;
    protected $purpose;

    public function __construct($file)
    {
        $this->file = $file;
        $this->purpose = 'pci_document';
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
