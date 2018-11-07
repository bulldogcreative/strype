<?php

namespace Bulldog\Strype\Resources\Files;

use Bulldog\Strype\Contracts\Resources\FilesInterface;

class DisputeEvidence implements FilesInterface
{
    protected $file;
    protected $purpose;

    public function __construct($file)
    {
        $this->file = $file;
        $this->purpose = 'dispute_evidence';
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
