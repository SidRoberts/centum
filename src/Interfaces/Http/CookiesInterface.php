<?php

namespace Centum\Interfaces\Http;

interface CookiesInterface
{
    public function add(CookieInterface $cookie): void;



    public function get(string $name): CookieInterface;

    public function has(string $name): bool;



    public function send(): void;



    /**
     * @return array<string, CookieInterface>
     */
    public function all(): array;

    /**
     * @return array<string, string>
     */
    public function toArray(): array;
}
