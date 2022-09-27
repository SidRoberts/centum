<?php

namespace Centum\Router;

use Centum\Interfaces\Filter\FilterInterface;
use Centum\Interfaces\Router\RouteInterface;

class Route implements RouteInterface
{
    protected readonly string $httpMethod;

    protected readonly string $uri;

    /** @var class-string */
    protected readonly string $class;

    protected readonly string $method;

    /** @var array<string, FilterInterface> */
    protected array $filters = [];



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



    public function getUriPattern(): string
    {
        $replacements = [
            "int"  => "[\d]+",
            "slug" => "[a-z0-9]+(?:\-[a-z0-9]+)*",
            "char" => "[^/]",
            "any"  => "[^/]+",
        ];

        $pattern = preg_replace_callback(
            "/\{([A-Za-z]+)(\:([a-z]+))?\}/",
            function (array $match) use ($replacements): string {
                $name = $match[1];

                $regExId = $match[3] ?? "any";

                $regEx = $replacements[$regExId] ?? $replacements["any"];

                return "(?P<" . $name . ">" . $regEx . ")";
            },
            $this->uri
        );

        $pattern = "#^" . $pattern . "$#u";

        return $pattern;
    }



    /**
     * @return array<string, FilterInterface>
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    public function addFilter(string $key, FilterInterface $filter): RouteInterface
    {
        $this->filters[$key] = $filter;

        return $this;
    }
}
