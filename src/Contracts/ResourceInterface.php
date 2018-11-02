<?php

namespace Bulldog\Strype\Contracts;

interface ResourceInterface
{
    /**
     * Returns the unique identifier for the object. Needed for ResourceInterface.
     *
     * @return string
     */
    public function getResourceId(): string;

    /**
     * Returns true if the object exists in live mode or false if the object
     * exists in test mode. Needed for ResourceInterface.
     *
     * @return bool
     */
    public function wasLiveMode(): bool;
}
