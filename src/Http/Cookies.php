<?php

namespace Centum\Http;

class Cookies
{
    /**
     * @var array<string, Cookie>
     */
    protected array $cookies = [];



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



    public function all() : array
    {
        return $this->cookies;
    }
}
