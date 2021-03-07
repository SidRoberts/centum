<?php

namespace Centum\Mvc;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Exception\InvalidMethodException;
use Centum\Mvc\Exception\ParamNotFoundException;
use Centum\Mvc\Exception\RouteMismatchException;
use Centum\Mvc\Exception\RouteNotFoundException;

class Router
{
    protected Container $container;

    protected array $routes = [
        "GET"     => [],
        "POST"    => [],
        "HEAD"    => [],
        "PUT"     => [],
        "DELETE"  => [],
        "TRACE"   => [],
        "OPTIONS" => [],
        "CONNECT" => [],
        "PATCH"   => [],
    ];



    public function __construct(Container $container)
    {
        $this->container = $container;
    }



    /**
     * @param class-string $class
     */
    public function get(string $uri, string $class, string $method) : Route
    {
        $route = new Route($uri, $class, $method);

        $this->routes["GET"][] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function post(string $uri, string $class, string $method) : Route
    {
        $route = new Route($uri, $class, $method);

        $this->routes["POST"][] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function head(string $uri, string $class, string $method) : Route
    {
        $route = new Route($uri, $class, $method);

        $this->routes["HEAD"][] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function put(string $uri, string $class, string $method) : Route
    {
        $route = new Route($uri, $class, $method);

        $this->routes["PUT"][] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function delete(string $uri, string $class, string $method) : Route
    {
        $route = new Route($uri, $class, $method);

        $this->routes["DELETE"][] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function trace(string $uri, string $class, string $method) : Route
    {
        $route = new Route($uri, $class, $method);

        $this->routes["TRACE"][] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function options(string $uri, string $class, string $method) : Route
    {
        $route = new Route($uri, $class, $method);

        $this->routes["OPTIONS"][] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function connect(string $uri, string $class, string $method) : Route
    {
        $route = new Route($uri, $class, $method);

        $this->routes["CONNECT"][] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function patch(string $uri, string $class, string $method) : Route
    {
        $route = new Route($uri, $class, $method);

        $this->routes["PATCH"][] = $route;

        return $route;
    }



    /**
     * @param class-string $class
     */
    public function submission(string $uri, string $class) : void
    {
        $this->get($uri, $class, "form");

        $this->post($uri, $class, "submit");
    }



    public function handle(Request $request) : Response
    {
        $method = $request->getMethod();

        /**
         * @var array
         */
        $routes = $this->routes[$method] ?? throw new InvalidMethodException();

        /**
         * @var Route $route
         */
        foreach ($routes as $route) {
            try {
                return $this->matchRouteToRequest($request, $route);
            } catch (RouteMismatchException $exception) {
                continue;
            }
        }

        throw new RouteNotFoundException($request);
    }



    protected function matchRouteToRequest(Request $request, Route $route) : Response
    {
        $uri = $request->getRequestUri();
        $uri = explode("?", $uri)[0];

        $pattern = $route->getUriPattern();

        if (preg_match($pattern, $uri, $params) !== 1) {
            throw new RouteMismatchException();
        }



        $middlewares = $route->getMiddlewares();

        /**
         * @var MiddlewareInterface $middleware
         */
        foreach ($middlewares as $middleware) {
            $success = $middleware->middleware($request, $route, $this->container);

            if (!$success) {
                throw new RouteMismatchException();
            }
        }



        // Remove integer keys from params.
        $params = array_filter(
            $params,
            function (mixed $value, mixed $key) {
                return !is_int($key);
            },
            ARRAY_FILTER_USE_BOTH
        );



        $converters = $route->getConverters();

        /**
         * @var ConverterInterface $converter
         */
        foreach ($converters as $key => $converter) {
            $value = $params[$key] ?? throw new ParamNotFoundException();

            $params[$key] = $converter->convert($value, $this->container);
        }



        $params = new Parameters($params);

        $this->container->set(Parameters::class, $params);
        $this->container->set(Request::class, $request);

        $class = $route->getClass();
        $method = $route->getMethod();

        $controller = $this->container->typehintClass($class);

        /**
         * @var Response
         */
        return $this->container->typehintMethod($controller, $method);
    }
}
