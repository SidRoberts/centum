<?php

namespace Centum\Container;

use Centum\Interfaces\Container\ParameterInterface;
use Exception;

class Parameter implements ParameterInterface
{
    /**
     * @param ?non-empty-string $type
     * @param ?non-empty-string $name
     * @param ?class-string     $declaringClass
     */
    public function __construct(
        protected ?string $type = null,
        protected ?string $name = null,
        protected bool $allowsNull = false,
        protected bool $hasDefaultValue = false,
        protected mixed $defaultValue = null,
        protected ?string $declaringClass = null
    ) {
    }



    /**
     * @psalm-mutation-free
     */
    public function hasType(): bool
    {
        return $this->type !== null;
    }

    /**
     * @psalm-mutation-free
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    public function isObject(): bool
    {
        return $this->type !== null && (class_exists($this->type) || interface_exists($this->type));
    }



    /**
     * @psalm-mutation-free
     */
    public function hasName(): bool
    {
        return $this->name !== null;
    }

    /**
     * @psalm-mutation-free
     */
    public function getName(): ?string
    {
        return $this->name;
    }



    public function allowsNull(): bool
    {
        return $this->allowsNull || ($this->hasDefaultValue && $this->defaultValue === null);
    }



    /**
     * @psalm-mutation-free
     */
    public function hasDefaultValue(): bool
    {
        return $this->hasDefaultValue;
    }

    /**
     * @psalm-mutation-free
     *
     * @throws Exception
     */
    public function getDefaultValue(): mixed
    {
        if (!$this->hasDefaultValue()) {
            throw new Exception();
        }

        return $this->defaultValue;
    }



    /**
     * @psalm-mutation-free
     */
    public function hasDeclaringClass(): bool
    {
        return $this->declaringClass !== null;
    }

    /**
     * @psalm-mutation-free
     */
    public function getDeclaringClass(): ?string
    {
        return $this->declaringClass;
    }
}
