<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Requests;

use Bulldog\Strype\Contracts\Resources\FilesInterface;

interface FileInterface extends \Bulldog\Strype\Contracts\RequestInterface
{
    public function create(FilesInterface $file, $arguments = [], $key = null);
}
