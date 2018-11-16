<?php



namespace Bulldog\Strype\Contracts\Resources;

interface FileLinkInterface extends \Bulldog\Strype\Contracts\ResourceInterface
{
    public function create(string $id, array $arguments = [], string $key = null): FileLinkInterface;
}
