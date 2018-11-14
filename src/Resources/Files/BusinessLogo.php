<?php

declare(strict_types=1);

namespace Bulldog\Strype\Resources\Files;

use Bulldog\Strype\Contracts\Resources\FilesInterface;

class BusinessLogo implements FilesInterface
{
    protected $file;
    protected $purpose;

    public function __construct($file)
    {
        $this->file = $file;
        $this->purpose = 'business_logo';
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getPurpose(): string
    {
        return $this->purpose;
    }
}
