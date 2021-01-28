<?php

namespace Centum\Mvc;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Exception\InvalidConverterException;
use Centum\Mvc\Exception\InvalidMiddlewareException;
use Centum\Mvc\Exception\ParamNotFoundException;
use Centum\Mvc\Exception\RouteNotFoundException;

class Router
{
    protected Container $container;

    protected array $routes = [];



    public function __construct(Container $container)
    {
        $this->container = $container;
    }



    public function addRoute(Route $route)
    {
        $this->routes[] = $route;
    }



    public function handle(Request $request) : Response
    {
        foreach ($this->routes as $route) {
            try {
                $params = $this->matchRouteToRequest($request, $route);
            } catch (RouteNotFoundException $exception) {
                $params = false;
            }

            if ($params !== false) {
                return $route->execute($request, $this->container, $params);
            }
        }

        throw new RouteNotFoundException($request);
    }



    protected function getUriPattern(Route $route) : string
    {
        $pattern = $route->getUri();

        $replacements = [
            "int"  => "[\d]+",
            "slug" => "[a-z0-9\-]+",
            "char" => "[^/]",
            "any"  => "[^/]+",
        ];

        $pattern = preg_replace_callback(
            "/\{([A-Za-z]+)(\:([a-z]+))?\}/",
            function ($match) use ($replacements) {
                $name = $match[1];
                $regExId = $match[3] ?? "any";

                $regEx = $replacements[$regExId] ?? $replacements["any"];

                return "(?P<" . $name . ">" . $regEx . ")";
            },
            $pattern
        );

        $pattern = "#^" . $pattern . "$#u";

        return $pattern;
    }



    protected function matchRouteToRequest(Request $request, Route $route) : array|bool
    {
        if ($route->getMethod() !== $request->getMethod()) {
            return false;
        }



        $uri = $request->getRequestUri();

        $pattern = $this->getUriPattern($route);

        if (preg_match($pattern, $uri, $params) !== 1) {
            return false;
        }



        $middlewares = $route->getMiddlewares();

        foreach ($middlewares as $middleware) {
            if (!($middleware instanceof MiddlewareInterface)) {
                throw new InvalidMiddlewareException();
            }

            $success = $middleware->middleware($request, $route, $this->container);

            if (!$success) {
                return false;
            }
        }



        // Remove integer keys from params.
        $params = array_filter(
            $params,
            function ($value, $key) {
                return !is_int($key);
            },
            ARRAY_FILTER_USE_BOTH
        );



        $converters = $route->getConverters();

        foreach ($converters as $key => $converter) {
            if (!($converter instanceof ConverterInterface)) {
                throw new InvalidConverterException();
            }

            if (!isset($params[$key])) {
                throw new ParamNotFoundException();
            }

            $value = $params[$key];

            $params[$key] = $converter->convert($value, $this->container);
        }



        return $params;
    }
}
