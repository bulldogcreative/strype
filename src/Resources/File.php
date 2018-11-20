<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Resources\FileInterface;
use Bulldog\Strype\Contracts\Models\FileTypeInterface;

/**
 * This is an object representing a file hosted on Stripe's servers. The file may
 * have been uploaded by yourself using the create file request (for example,
 * when uploading dispute evidence) or it may have been created by Stripe (for
 *  example, the results of a Sigma scheduled query).
 *
 * @see https://stripe.com/docs/api/files
 */
class File extends Resource implements FileInterface
{
    use Retrieve, ListAll;

    /**
     * Create a file.
     *
     * @see https://stripe.com/docs/api/files/create
     *
     * @param FileTypeInterface $file
     * @param array             $arguments
     * @param string|null       $key
     *
     * @return FileInterface
     */
    public function create(FileTypeInterface $file, array $arguments = [], string $key = null): FileInterface
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
