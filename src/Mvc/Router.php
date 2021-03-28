<?php

namespace Centum\Mvc;

use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Exception\ParamNotFoundException;
use Centum\Mvc\Exception\RouteMismatchException;
use Centum\Mvc\Exception\RouteNotFoundException;

class Router
{
    protected Container $container;

    /**
     * @var Route[]
     */
    protected array $routes = [];

    /**
     * @var array<class-string, array>
     */
    protected array $exceptionHandlers = [];



    public function __construct(Container $container)
    {
        $this->container = $container;
    }



    /**
     * @param class-string $class
     */
    public function get(string $uri, string $class, string $method) : Route
    {
        $route = new Route("GET", $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function post(string $uri, string $class, string $method) : Route
    {
        $route = new Route("POST", $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function head(string $uri, string $class, string $method) : Route
    {
        $route = new Route("HEAD", $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function put(string $uri, string $class, string $method) : Route
    {
        $route = new Route("PUT", $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function delete(string $uri, string $class, string $method) : Route
    {
        $route = new Route("DELETE", $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function trace(string $uri, string $class, string $method) : Route
    {
        $route = new Route("TRACE", $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function options(string $uri, string $class, string $method) : Route
    {
        $route = new Route("OPTIONS", $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function connect(string $uri, string $class, string $method) : Route
    {
        $route = new Route("CONNECT", $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function patch(string $uri, string $class, string $method) : Route
    {
        $route = new Route("PATCH", $uri, $class, $method);

        $this->routes[] = $route;

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



    /**
     * @param class-string $exceptionClass
     * @param class-string $class
     */
    public function addExceptionHandler(string $exceptionClass, string $class, string $method) : void
    {
        $this->exceptionHandlers[$exceptionClass] = [
            $class,
            $method,
        ];
    }



    public function handle(Request $request) : Response
    {
        try {
            foreach ($this->routes as $route) {
                try {
                    return $this->matchRouteToRequest($request, $route);
                } catch (RouteMismatchException $exception) {
                    continue;
                }
            }

            throw new RouteNotFoundException($request);
        } catch (\Throwable $exception) {
            foreach ($this->exceptionHandlers as $exceptionClass => $path) {
                if (is_a($exception, $exceptionClass)) {
                    $this->container->set(Request::class, $request);

                    $class  = $path[0];
                    $method = $path[1];

                    return $this->executeMethod($class, $method);
                }
            }

            throw $exception;
        }
    }


    protected function matchRouteToRequest(Request $request, Route $route) : Response
    {
        if ($request->getMethod() !== $route->getHttpMethod()) {
            throw new RouteMismatchException();
        }



        $uri = $request->getUri();
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
            function (mixed $value, mixed $key) : bool {
                return !is_int($key);
            },
            ARRAY_FILTER_USE_BOTH
        );



        $converters = $route->getConverters();

        foreach ($converters as $key => $converter) {
            /**
             * @var string
             */
            $value = $params[$key] ?? throw new ParamNotFoundException();

            /**
             * @var mixed
             */
            $params[$key] = $converter->convert($value, $this->container);
        }



        $params = new Parameters($params);

        $this->container->set(Parameters::class, $params);
        $this->container->set(Request::class, $request);

        $class  = $route->getClass();
        $method = $route->getMethod();

        return $this->executeMethod($class, $method);
    }

    /**
     * @param class-string $class
     */
    protected function executeMethod(string $class, string $method) : Response
    {
        $controller = $this->container->typehintClass($class);

        /**
         * @var Response
         */
        return $this->container->typehintMethod($controller, $method);
    }
}
