<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Resources;

interface FilesInterface
{
    public function getFile();

    public function getPurpose(): string;
}
