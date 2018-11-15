<?php

namespace Bulldog\Strype\Models\Duration;

use Bulldog\Strype\Contracts\Models\DurationInterface;

class Once implements DurationInterface
{
    public function toArray(): array
    {
        return [
            'duration' => 'once',
        ];
    }
}
