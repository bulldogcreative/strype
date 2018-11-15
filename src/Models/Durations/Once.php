<?php

namespace Bulldog\Strype\Models\Durations;

use Bulldog\Strype\Contracts\Models\DurationTypeInterface;

class Once implements DurationTypeInterface
{
    public function toArray(): array
    {
        return [
            'duration' => 'once',
        ];
    }
}
