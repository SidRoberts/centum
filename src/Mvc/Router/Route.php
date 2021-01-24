<?php

namespace Centum\Mvc\Router;

use Centum\Mvc\Dispatcher\Path;
use Centum\Mvc\Router\Route\Converter;
use Centum\Mvc\Router\Route\Middleware;
use Centum\Mvc\Router\Route\Requirement;
use Centum\Mvc\Router\Route\Uri;

class Route
{
    protected Uri $uri;

    protected Path $path;

    protected array $requirements;

    protected array $middlewares;

    protected array $converters;

    protected $compiledPattern;



    public function __construct(
        Uri $uri,
        Path $path,
        array $requirements = [],
        array $middlewares = [],
        array $converters = []
    ) {
        $this->uri          = $uri;
        $this->path         = $path;
        $this->requirements = $requirements;
        $this->middlewares  = $middlewares;
        $this->converters   = $converters;

        $this->createCompiledPattern();
    }



    public function getUri() : Uri
    {
        return $this->uri;
    }

    public function getPath() : Path
    {
        return $this->path;
    }

    public function getRequirements() : array
    {
        return $this->requirements;
    }

    public function getMiddlewares() : array
    {
        $middlewareAttributes = $this->middlewares;

        $middlewares = [];

        foreach ($middlewareAttributes as $attribute) {
            $middlewares[] = $attribute->getMiddleware();
        }

        return $middlewares;
    }

    public function getConverters() : array
    {
        return $this->converters;
    }

    public function getCompiledPattern()
    {
        return $this->compiledPattern;
    }



    protected function createCompiledPattern()
    {
        $pattern = $this->getUri()->getUri();

        // Get parameter names from URI.
        preg_match_all(
            "/\{([A-Za-z]+)\}/",
            $pattern,
            $matches
        );

        $params = array_flip(
            $matches[1]
        );

        // Assume every parameter has no requirement - any value is allowed.
        foreach ($params as $key => $value) {
            $params[$key] = "[^/]+";
        }

        $requirements = [];

        foreach ($this->requirements as $requirement) {
            $param = $requirement->getParam();
            $regEx = $requirement->getRegEx();

            $requirements[$param] = $regEx;
        }

        // Merge with the requirements.
        $params = array_merge(
            $params,
            $requirements
        );

        foreach ($params as $param => $regEx) {
            $pattern = str_replace(
                "{" . $param . "}",
                "(?P<" . $param . ">" . $regEx . ")",
                $pattern
            );
        }

        $this->compiledPattern = "#^" . $pattern . "$#u";
    }
}
