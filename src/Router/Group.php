<?php

namespace Centum\Router;

class Group
{
    protected readonly MiddlewareInterface $middleware;

    /** @var Route[] */
    protected array $routes = [];



    public function __construct(MiddlewareInterface $middleware)
    {
        $this->middleware = $middleware;
    }



    public function getMiddleware(): MiddlewareInterface
    {
        return $this->middleware;
    }

    /**
     * @return Route[]
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }



    /**
     * @param class-string $class
     */
    public function get(string $uri, string $class, string $method): Route
    {
        $route = new Route("GET", $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function post(string $uri, string $class, string $method): Route
    {
        $route = new Route("POST", $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function head(string $uri, string $class, string $method): Route
    {
        $route = new Route("HEAD", $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function put(string $uri, string $class, string $method): Route
    {
        $route = new Route("PUT", $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function delete(string $uri, string $class, string $method): Route
    {
        $route = new Route("DELETE", $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function trace(string $uri, string $class, string $method): Route
    {
        $route = new Route("TRACE", $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function options(string $uri, string $class, string $method): Route
    {
        $route = new Route("OPTIONS", $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function connect(string $uri, string $class, string $method): Route
    {
        $route = new Route("CONNECT", $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string $class
     */
    public function patch(string $uri, string $class, string $method): Route
    {
        $route = new Route("PATCH", $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }



    /**
     * @param class-string $class
     */
    public function crud(string $uri, string $class): void
    {
        $this->get($uri, $class, "index");



        $this->get($uri . "/create", $class, "create");

        $this->post($uri, $class, "store");



        $this->get($uri . "/{id}", $class, "show");



        $this->get($uri . "/{id}/edit", $class, "edit");

        $this->put($uri . "/{id}", $class, "update");
        $this->patch($uri . "/{id}", $class, "update");



        $this->delete($uri . "/{id}", $class, "destroy");
    }

    /**
     * @param class-string $class
     */
    public function submission(string $uri, string $class): void
    {
        $this->get($uri, $class, "form");

        $this->post($uri, $class, "submit");
    }
}
