<?php

namespace Bulldog\Strype\Contracts\Models;

interface FileTypeInterface
{
    public function getFile();

    public function getPurpose(): string;
}
