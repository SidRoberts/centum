<?php

namespace Centum\Http;

class Cookies
{
    /**
     * @var array<string, Cookie>
     */
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



    public function add(Cookie $cookie) : void
    {
        $name = $cookie->getName();

        $this->cookies[$name] = $cookie;
    }



    /**
     * @return array<string, Cookie>
     */
    public function all() : array
    {
        return $this->cookies;
    }

    public function toArray() : array
    {
        $cookies = [];

        foreach ($this->cookies as $name => $cookie) {
            $cookies[$name] = $cookie->getValue();
        }

        return $cookies;
    }
}
