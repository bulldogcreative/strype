<?php

namespace Bulldog\Strype\Contracts\Resources;

interface ProductTypeInterface
{
    public function getName(): string;

    public function getType(): string;

    public function getArguments(): array;
}
