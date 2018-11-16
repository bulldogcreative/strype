<?php

namespace Bulldog\Strype\Models\Files;

use Bulldog\Strype\Models\File;

class BusinessLogo extends File
{
    public function __construct($file)
    {
        $this->file = $file;
        $this->purpose = 'business_logo';
    }
}
