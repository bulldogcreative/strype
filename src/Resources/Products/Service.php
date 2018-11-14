<?php

declare(strict_types=1);

namespace Bulldog\Strype\Resources\Products;

use Bulldog\Strype\Contracts\Resources\ProductTypeInterface;

class Service implements ProductTypeInterface
{
    protected $name;
    protected $arguments;

    public function __construct(string $name, array $arguments = [])
    {
        $this->name = $name;
        $this->arguments = $arguments;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return 'service';
    }

    public function getArguments(): array
    {
        $this->arguments['name'] = $this->name;
        $this->arguments['type'] = $this->getType();

        return $this->arguments;
    }
}
