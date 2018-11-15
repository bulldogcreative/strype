<?php

namespace Bulldog\Strype\Models\Files;

use Bulldog\Strype\Models\File;

class CustomerSignature extends File
{
    public function __construct($file)
    {
        $this->file = $file;
        $this->purpose = 'customer_signature';
    }
}
