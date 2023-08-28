<?php

namespace Centum\Router;

use Centum\Interfaces\Router\ControllerInterface;
use Centum\Interfaces\Router\RouteInterface;

class Route implements RouteInterface
{
    /**
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function __construct(
        protected readonly string $httpMethod,
        protected readonly string $uri,
        protected readonly string $class,
        protected readonly string $method
    ) {
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
     * @return class-string<ControllerInterface>
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @return non-empty-string
     */
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
