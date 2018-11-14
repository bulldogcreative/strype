<?php

declare(strict_types=1);

namespace Bulldog\Strype\Contracts\Resources;

interface ProductTypeInterface
{
    public function getName(): string;

    public function getType(): string;

    public function getArguments(): array;
}
