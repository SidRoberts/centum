<?php

namespace Centum\Interfaces\Http;

use Centum\Http\Cookie;

interface CookiesInterface
{
    public function add(Cookie $cookie): void;



    public function get(string $name): Cookie;

    public function has(string $name): bool;



    public function send(): void;



    /**
     * @return array<string, Cookie>
     */
    public function all(): array;

    public function toArray(): array;
}
