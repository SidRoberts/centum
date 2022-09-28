<?php

namespace Centum\Interfaces\Http;

interface HeadersInterface
{
    public function add(HeaderInterface $header): void;



    public function get(string $name): HeaderInterface;

    public function has(string $name): bool;



    public function send(): void;



    /**
     * @return array<string, HeaderInterface>
     */
    public function all(): array;

    public function toArray(): array;
}
