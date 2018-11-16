<?php



namespace Bulldog\Strype\Contracts\Traits;

/**
 * Interface DeleteInterface.
 */
interface DeleteInterface
{
    /**
     * @param string $id
     *
     * @return mixed
     */
    public function delete(string $id);
}
