<?php

namespace Centum\Router;

use Centum\Interfaces\Router\RouteInterface;

class Route implements RouteInterface
{
    protected readonly string $httpMethod;

    protected readonly string $uri;

    /** @var class-string */
    protected readonly string $class;

    protected readonly string $method;



    /**
     * @param class-string $class
     */
    public function __construct(string $httpMethod, string $uri, string $class, string $method)
    {
        $this->httpMethod = $httpMethod;
        $this->uri        = $uri;
        $this->class      = $class;
        $this->method     = $method;
    }



    public function getHttpMethod(): string
    {
        return $this->httpMethod;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return class-string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    public function getMethod(): string
    {
        return $this->method;
    }



    /**
     * @return array<string, string>
     */
    public function getParameters(): array
    {
        preg_match_all(
            "/\{([A-Za-z0-9]+)(\:([A-Za-z]+))?\}/",
            $this->uri,
            $matches
        );

        $parameters = [];

        foreach ($matches[1] as $i => $key) {
            $parameters[$key] = $matches[3][$i] ?: "any";
        }

        return $parameters;
    }
}
