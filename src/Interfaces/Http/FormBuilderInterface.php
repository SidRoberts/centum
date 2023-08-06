<?php

namespace Centum\Interfaces\Http;

interface FormBuilderInterface
{
    /**
     * @template T of object
     * @psalm-param class-string<T> $class
     * @psalm-return T
     */
    public function build(string $class): object;
}
