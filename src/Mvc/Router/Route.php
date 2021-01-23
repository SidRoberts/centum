<?php

namespace Centum\Mvc\Router;

use Centum\Mvc\Dispatcher\Path;
use Centum\Mvc\Router\Route\Converters;
use Centum\Mvc\Router\Route\Middlewares;
use Centum\Mvc\Router\Route\Requirements;
use Centum\Mvc\Router\Route\Uri;

class Route
{
    protected Uri $uri;

    protected Path $path;

    protected Requirements $requirements;

    protected Middlewares $middlewares;

    protected Converters $converters;

    protected $compiledPattern;



    public function __construct(
        Uri $uri,
        Path $path,
        Requirements $requirements = null,
        Middlewares $middlewares = null,
        Converters $converters = null
    ) {
        $this->uri          = $uri;
        $this->path         = $path;
        $this->requirements = $requirements ?: new Requirements([]);
        $this->middlewares  = $middlewares ?: new Middlewares([]);
        $this->converters   = $converters ?: new Converters([]);

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

    public function getRequirements() : Requirements
    {
        return $this->requirements;
    }

    public function getMiddlewares() : Middlewares
    {
        return $this->middlewares;
    }

    public function getConverters() : Converters
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

        // Merge with the requirements.
        $params = array_merge(
            $params,
            $this->requirements->toArray()
        );

        foreach ($params as $param => $requirement) {
            $pattern = str_replace(
                "{" . $param . "}",
                "(?P<" . $param . ">" . $requirement . ")",
                $pattern
            );
        }

        $this->compiledPattern = "#^" . $pattern . "$#u";
    }
}
