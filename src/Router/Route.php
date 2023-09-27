<?php

namespace Centum\Router;

use Centum\Http\Method;
use Centum\Interfaces\Router\ControllerInterface;
use Centum\Interfaces\Router\RouteInterface;

class Route implements RouteInterface
{
    /**
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string                  $method
     */
    public function __construct(
        protected readonly Method $httpMethod,
        protected readonly string $uri,
        protected readonly string $class,
        protected readonly string $method
    ) {
    }



    public function getHttpMethod(): string
    {
        return $this->httpMethod->value;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getMethod(): string
    {
        return $this->method;
    }



    public function getParameters(): array
    {
        preg_match_all(
            "/\{([A-Za-z0-9]+)(\:([A-Za-z]+))?\}/",
            $this->uri,
            $matches
        );

        $parameters = [];

        /**
         * @var non-empty-string $key
         */
        foreach ($matches[1] as $i => $key) {
            $parameters[$key] = $matches[3][$i] ?: "any";
        }

        return $parameters;
    }
}
