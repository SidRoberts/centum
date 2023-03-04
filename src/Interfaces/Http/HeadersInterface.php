<?php

namespace Centum\Interfaces\Http;

interface HeadersInterface
{
    public function add(HeaderInterface $header): void;

    /**
     * @param HeaderInterface[] $headers
     */
    public function addMultiple(array $headers): void;



    public function get(string $name): HeaderInterface;

    public function has(string $name): bool;

    public function matches(string $name, string $value): bool;



    public function send(): void;



    /**
     * @return array<string, HeaderInterface>
     */
    public function all(): array;

    /**
     * @return array<string, string>
     */
    public function toArray(): array;
}
