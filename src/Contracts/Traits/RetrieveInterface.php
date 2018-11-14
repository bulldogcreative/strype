<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Traits;

/**
 * Interface RetrieveInterface.
 */
interface RetrieveInterface
{
    /**
     * @param string $id
     *
     * @return mixed
     */
    public function retrieve(string $id);
}
