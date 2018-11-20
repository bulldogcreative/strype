<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Resources\FileLinkInterface;

/**
 * To share the contents of a File object with non-Stripe users, you can create
 * a FileLink. FileLinks contain a URL that can be used to retrieve the contents
 * of the file without authentication.
 *
 * @see https://stripe.com/docs/api/file_links
 */
class FileLink extends Resource implements FileLinkInterface
{
    use Retrieve, Update, ListAll;

    /**
     * Creates a new file link object.
     *
     * @see https://stripe.com/docs/api/file_links/create
     *
     * @param string $id
     * @param array  $arguments
     * @param string $key
     *
     * @return FileLinkInterface
     */
    public function create(string $id, array $arguments = [], string $key = null): FileLinkInterface
    {
        $arguments['file'] = $id;
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    protected function stripe(string $method, $arguments, $idempotencyKey = null): void
    {
        $this->response = \Stripe\FileLink::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
