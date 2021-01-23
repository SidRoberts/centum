<?php

namespace Centum\Mvc\Router\Route;

use Attribute;
use InvalidArgumentException;

#[Attribute]
class Uri
{
    protected string $uri;
    protected string $method;



    public function __construct(string $uri, string $method = "GET")
    {
        $this->uri    = $uri;
        $this->method = $method;
    }



    public function getUri() : string
    {
        return $this->uri;
    }

    public function getMethod() : string
    {
        return $this->method;
    }
}
