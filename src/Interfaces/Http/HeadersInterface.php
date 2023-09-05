<?php

namespace Centum\Interfaces\Http;

interface HeadersInterface
{
    public function add(HeaderInterface $header): void;

    /**
     * @param array<HeaderInterface> $headers
     */
    public function addMultiple(array $headers): void;



    /**
     * @param non-empty-string $name
     */
    public function get(string $name): HeaderInterface;

    /**
     * @param non-empty-string $name
     */
    public function has(string $name): bool;

    /**
     * @param non-empty-string $name
     */
    public function matches(string $name, string $value): bool;



    public function send(): void;



    /**
     * @return array<non-empty-string, HeaderInterface>
     */
    public function all(): array;

    /**
     * @return array<non-empty-string, string>
     */
    public function toArray(): array;
}
