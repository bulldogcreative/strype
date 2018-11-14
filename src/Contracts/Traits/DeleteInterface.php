<?php

declare(strict_types=1);

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
