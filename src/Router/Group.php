<?php

namespace Centum\Router;

use Centum\Http\Method;
use Centum\Interfaces\Router\ControllerInterface;
use Centum\Interfaces\Router\GroupInterface;
use Centum\Interfaces\Router\MiddlewareInterface;
use Centum\Interfaces\Router\RouteInterface;

class Group implements GroupInterface
{
    /** @var array<RouteInterface> */
    protected array $routes = [];



    public function __construct(
        protected readonly MiddlewareInterface $middleware
    ) {
    }



    public function getMiddleware(): MiddlewareInterface
    {
        return $this->middleware;
    }

    /**
     * @return array<RouteInterface>
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }



    /**
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function get(string $uri, string $class, string $method): RouteInterface
    {
        $route = new Route(Method::GET, $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function post(string $uri, string $class, string $method): RouteInterface
    {
        $route = new Route(Method::POST, $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function head(string $uri, string $class, string $method): RouteInterface
    {
        $route = new Route(Method::HEAD, $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function put(string $uri, string $class, string $method): RouteInterface
    {
        $route = new Route(Method::PUT, $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function delete(string $uri, string $class, string $method): RouteInterface
    {
        $route = new Route(Method::DELETE, $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function trace(string $uri, string $class, string $method): RouteInterface
    {
        $route = new Route(Method::TRACE, $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function options(string $uri, string $class, string $method): RouteInterface
    {
        $route = new Route(Method::OPTIONS, $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function connect(string $uri, string $class, string $method): RouteInterface
    {
        $route = new Route(Method::CONNECT, $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function patch(string $uri, string $class, string $method): RouteInterface
    {
        $route = new Route(Method::PATCH, $uri, $class, $method);

        $this->routes[] = $route;

        return $route;
    }



    /**
     * @param class-string<ControllerInterface> $class
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
     * @param class-string<ControllerInterface> $class
     */
    public function submission(string $uri, string $class): void
    {
        $this->get($uri, $class, "form");

        $this->post($uri, $class, "submit");
    }
}
