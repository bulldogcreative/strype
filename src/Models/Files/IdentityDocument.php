<?php

namespace Bulldog\Strype\Models\Files;

use Bulldog\Strype\Models\File;

class IdentityDocument extends File
{
    public function __construct($file)
    {
        $this->file = $file;
        $this->purpose = 'identity_document';
    }
}
