<?php

namespace Centum\Mvc;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Exception\RouteNotFoundException;

class Route
{
    protected string $httpMethod;

    protected string $uri;

    /**
     * @var class-string
     */
    protected string $class;

    protected string $method;

    /**
     * @var MiddlewareInterface[] $middlewares
     */
    protected array $middlewares = [];

    /**
     * @var ConverterInterface[] $converters
     */
    protected array $converters = [];



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



    public function getHttpMethod() : string
    {
        return $this->httpMethod;
    }

    public function getUri() : string
    {
        return $this->uri;
    }

    /**
     * @return class-string
     */
    public function getClass() : string
    {
        return $this->class;
    }

    public function getMethod() : string
    {
        return $this->method;
    }



    public function getUriPattern() : string
    {
        $replacements = [
            "int"  => "[\d]+",
            "slug" => "[a-z0-9\-]+",
            "char" => "[^/]",
            "any"  => "[^/]+",
        ];

        $pattern = preg_replace_callback(
            "/\{([A-Za-z]+)(\:([a-z]+))?\}/",
            function (array $match) use ($replacements) : string {
                /**
                 * @var string
                 */
                $name = $match[1];

                /**
                 * @var string
                 */
                $regExId = $match[3] ?? "any";

                $regEx = $replacements[$regExId] ?? $replacements["any"];

                return "(?P<" . $name . ">" . $regEx . ")";
            },
            $this->uri
        );

        $pattern = "#^" . $pattern . "$#u";

        return $pattern;
    }



    public function getMiddlewares() : array
    {
        return $this->middlewares;
    }

    public function addMiddleware(MiddlewareInterface $middleware) : Route
    {
        $this->middlewares[] = $middleware;

        return $this;
    }



    public function getConverters() : array
    {
        return $this->converters;
    }

    public function addConverter(string $key, ConverterInterface $converter) : Route
    {
        $this->converters[$key] = $converter;

        return $this;
    }
}
