<?php

namespace Bulldog\Strype\Models\Duration;

use Bulldog\Strype\Contracts\Models\DurationInterface;

class Forever implements DurationInterface
{
    public function toArray(): array
    {
        return [
            'duration' => 'forever',
        ];
    }
}
