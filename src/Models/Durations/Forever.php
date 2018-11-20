<?php

namespace Bulldog\Strype\Models\Durations;

use Bulldog\Strype\Contracts\Models\DurationTypeInterface;

/**
 * Used for indicating the duration is forever.
 */
class Forever implements DurationTypeInterface
{
    public function toArray(): array
    {
        return [
            'duration' => 'forever',
        ];
    }
}
