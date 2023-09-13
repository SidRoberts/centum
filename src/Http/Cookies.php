<?php

namespace Centum\Http;

use Centum\Interfaces\Http\CookieInterface;
use Centum\Interfaces\Http\CookiesInterface;
use OutOfRangeException;

class Cookies implements CookiesInterface
{
    /**
     * @var array<non-empty-string, CookieInterface>
     */
    protected array $cookies = [];



    /**
     * @param array<CookieInterface> $cookies
     */
    public function __construct(array $cookies = [])
    {
        foreach ($cookies as $cookie) {
            $this->add($cookie);
        }
    }



    public function add(CookieInterface $cookie): void
    {
        $name = $cookie->getName();

        $this->cookies[$name] = $cookie;
    }



    /**
     * @throws OutOfRangeException
     */
    public function get(string $name): CookieInterface
    {
        if (!isset($this->cookies[$name])) {
            throw new OutOfRangeException();
        }

        return $this->cookies[$name];
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
