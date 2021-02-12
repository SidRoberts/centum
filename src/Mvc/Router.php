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



    public function addRoute(Route $route) : void
    {
        $this->routes[] = $route;
    }



    public function handle(Request $request) : Response
    {
        foreach ($this->routes as $route) {
            try {
                $response = $this->matchRouteToRequest($request, $route);

                if ($response !== false) {
                    return $response;
                }
            } catch (RouteNotFoundException $exception) {
                continue;
            }
        }

        throw new RouteNotFoundException($request);
    }



    protected function getUriPattern(Route $route) : string
    {
        $pattern = $route->uri();

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



    protected function matchRouteToRequest(Request $request, Route $route) : Response|bool
    {
        $uri = $request->getRequestUri();

        $pattern = $this->getUriPattern($route);

        if (preg_match($pattern, $uri, $params) !== 1) {
            return false;
        }



        $middlewares = $route->middlewares();

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



        $converters = $route->converters();

        foreach ($converters as $key => $converter) {
            if (!($converter instanceof ConverterInterface)) {
                throw new InvalidConverterException();
            }

            $value = $params[$key] ?? throw new ParamNotFoundException();

            $params[$key] = $converter->convert($value, $this->container);
        }



        $method = strtolower($request->getMethod());

        $allowedMethods = [
            "get",
            "post",
            "head",
            "put",
            "delete",
            "trace",
            "options",
            "connect",
            "patch",
        ];

        if (!in_array($method, $allowedMethods)) {
            throw new RouteNotFoundException();
        }

        return call_user_func_array(
            [
                $route,
                $method,
            ],
            [
                $request,
                $this->container,
                $params,
            ]
        );
    }
}
