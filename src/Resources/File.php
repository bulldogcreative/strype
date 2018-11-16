<?php



namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Contracts\Models\FileTypeInterface;
use Bulldog\Strype\Contracts\Requests\FileInterface;
use Bulldog\Strype\Contracts\Traits\ListAllInterface;
use Bulldog\Strype\Contracts\Traits\RetrieveInterface;
use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\ListAll;
use Bulldog\Strype\Traits\Retrieve;

class File extends Resource implements FileInterface, RetrieveInterface, ListAllInterface
{
    use Retrieve, ListAll;

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
