<?php

namespace Bulldog\Strype\Models\Files;

use Bulldog\Strype\Models\File;

class PciDocument extends File
{
    public function __construct($file)
    {
        $this->file = $file;
        $this->purpose = 'pci_document';
    }
}
