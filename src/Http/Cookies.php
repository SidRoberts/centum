<?php

namespace Centum\Http;

use Centum\Interfaces\Http\CookiesInterface;
use OutOfRangeException;

class Cookies implements CookiesInterface
{
    /** @var array<string, Cookie> */
    protected array $cookies = [];



    /**
     * @param Cookie[] $cookies
     */
    public function __construct(array $cookies = [])
    {
        foreach ($cookies as $cookie) {
            $this->add($cookie);
        }
    }



    public function add(Cookie $cookie): void
    {
        $name = $cookie->getName();

        $this->cookies[$name] = $cookie;
    }



    public function get(string $name): Cookie
    {
        return $this->cookies[$name] ?? throw new OutOfRangeException();
    }

    public function has(string $name): bool
    {
        return isset($this->cookies[$name]);
    }



    public function send(): void
    {
        foreach ($this->cookies as $cookie) {
            $cookie->send();
        }
    }



    /**
     * @return array<string, Cookie>
     */
    public function all(): array
    {
        return $this->cookies;
    }

    public function toArray(): array
    {
        $cookies = [];

        foreach ($this->cookies as $name => $cookie) {
            $cookies[$name] = $cookie->getValue();
        }

        return $cookies;
    }
}
