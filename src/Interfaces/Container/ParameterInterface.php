<?php

namespace Centum\Interfaces\Container;

interface ParameterInterface
{
    /**
     * @psalm-mutation-free
     *
     * @psalm-assert-if-true non-empty-string $this->getType()
     *
     * @psalm-assert-if-false null $this->getType()
     */
    public function hasType(): bool;

    /**
     * @psalm-mutation-free
     *
     * @return ?non-empty-string
     */
    public function getType(): ?string;

    /**
     * @psalm-assert-if-true class-string $this->getType()
     */
    public function isObject(): bool;



    /**
     * @psalm-mutation-free
     *
     * @psalm-assert-if-true non-empty-string $this->getName()
     *
     * @psalm-assert-if-false null $this->getName()
     */
    public function hasName(): bool;

    /**
     * @psalm-mutation-free
     *
     * @return ?non-empty-string
     */
    public function getName(): ?string;



    public function allowsNull(): bool;



    public function hasDefaultValue(): bool;

    public function getDefaultValue(): mixed;



    /**
     * @psalm-mutation-free
     *
     * @psalm-assert-if-true class-string $this->getDeclaringClass()
     *
     * @psalm-assert-if-false null $this->getDeclaringClass()
     */
    public function hasDeclaringClass(): bool;

    /**
     * @psalm-mutation-free
     *
     * @return ?class-string
     */
    public function getDeclaringClass(): ?string;
}
