<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Update;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Traits\UpdateInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Contracts\Resources\FileLinkInterface;

/**
 * FileLink class.
 *
 * @see https://stripe.com/docs/api/file_links
 */
class FileLink extends Resource implements FileLinkInterface, RetrieveInterface, ListAllInterface, UpdateInterface
{
    use Retrieve, Update, ListAll;

    /**
     * Create a file link.
     *
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
