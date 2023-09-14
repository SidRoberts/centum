<?php

namespace Centum\Interfaces\Http;

interface CookiesInterface
{
    /**
     * @param non-empty-string $name
     */
    public function get(string $name): CookieInterface;

    /**
     * @param non-empty-string $name
     */
    public function has(string $name): bool;



    public function send(): void;



    /**
     * @return array<non-empty-string, CookieInterface>
     */
    public function all(): array;

    /**
     * @return array<non-empty-string, string>
     */
    public function toArray(): array;
}
