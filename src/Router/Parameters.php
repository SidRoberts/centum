<?php

namespace Centum\Router;

use Centum\Interfaces\Router\ParametersInterface;

class Parameters implements ParametersInterface
{
    /**
     * @param array<string, mixed> $parameters
     */
    public function __construct(
        protected readonly array $parameters
    ) {
    }



    public function get(string $name, mixed $defaultValue = null): mixed
    {
        return $this->parameters[$name] ?? $defaultValue;
    }

    public function has(string $name): bool
    {
        return array_key_exists($name, $this->parameters);
    }



    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return $this->parameters;
    }
}
