<?php

namespace Bulldog\Strype\Contracts\Models;

interface FileInterface
{
    public function getFile();

    public function getPurpose(): string;
}
