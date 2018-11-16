<?php



namespace Bulldog\Strype\Contracts\Traits;

/**
 * Interface UpdateInterface.
 */
interface UpdateInterface
{
    /**
     * @param string $id
     * @param array  $data
     *
     * @return mixed
     */
    public function update(string $id, array $data);
}
