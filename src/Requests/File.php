<?php

declare(strict_types=1);

namespace Bulldog\Strype\Requests;

use Bulldog\Strype\Request;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Requests\FileInterface;
use Bulldog\Strype\Contracts\Resources\FilesInterface;

class File extends Request implements FileInterface, RetrieveInterface, ListAllInterface
{
    use Retrieve, ListAll;

    public function create(FilesInterface $file, $arguments = [], $key = null)
    {
        $arguments['purpose'] = $file->getPurpose();
        $arguments['file'] = $file->getFile();

        $this->stripe('create', $arguments, $key);

        return $this;
    }

    protected function stripe(string $method, $arguments, $idempotencyKey = null) : void
    {
        $this->response = \Stripe\File::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
