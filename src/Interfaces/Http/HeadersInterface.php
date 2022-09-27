<?php

namespace Centum\Interfaces\Http;

use Centum\Http\Header;

interface HeadersInterface
{
    public function add(Header $header): void;



    public function get(string $name): Header;

    public function has(string $name): bool;



    public function send(): void;



    /**
     * @return array<string, Header>
     */
    public function all(): array;

    public function toArray(): array;
}
