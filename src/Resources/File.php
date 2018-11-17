<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Resources\FileInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Models\FileTypeInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;

/**
 * File class.
 *
 * @see https://stripe.com/docs/api/files
 */
class File extends Resource implements FileInterface, RetrieveInterface, ListAllInterface
{
    use Retrieve, ListAll;

    /**
     * Create a file.
     *
     * @see https://stripe.com/docs/api/files/create
     *
     * @param FileTypeInterface $file
     * @param array             $arguments
     * @param [type]            $key
     *
     * @return FileInterface
     */
    public function create(FileTypeInterface $file, array $arguments = [], $key = null): FileInterface
    {
        $arguments['purpose'] = $file->getPurpose();
        $arguments['file'] = $file->getFile();

        $this->stripe('create', $arguments, $key);

        return $this;
    }

    protected function stripe(string $method, $arguments, string $idempotencyKey = null): void
    {
        $this->response = \Stripe\File::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
