<?php

namespace Centum\Interfaces\Router;

interface GroupInterface
{
    public function getMiddleware(): MiddlewareInterface;

    /**
     * @return array<RouteInterface>
     */
    public function getRoutes(): array;



    /**
     * Add a route for a GET request.
     *
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function get(string $uri, string $class, string $method): RouteInterface;

    /**
     * Add a route for a POST request.
     *
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function post(string $uri, string $class, string $method): RouteInterface;

    /**
     * Add a route for a HEAD request.
     *
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function head(string $uri, string $class, string $method): RouteInterface;

    /**
     * Add a route for a PUT request.
     *
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function put(string $uri, string $class, string $method): RouteInterface;

    /**
     * Add a route for a DELETE request.
     *
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function delete(string $uri, string $class, string $method): RouteInterface;

    /**
     * Add a route for an TRACE request.
     *
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function trace(string $uri, string $class, string $method): RouteInterface;

    /**
     * Add a route for an OPTIONS request.
     *
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function options(string $uri, string $class, string $method): RouteInterface;

    /**
     * Add a route for a CONNECT request.
     *
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function connect(string $uri, string $class, string $method): RouteInterface;

    /**
     * Add a route for a PATCH request.
     *
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function patch(string $uri, string $class, string $method): RouteInterface;



    /**
     * @param class-string<ControllerInterface> $class
     */
    public function crud(string $uri, string $class): void;

    /**
     * @param class-string<ControllerInterface> $class
     */
    public function submission(string $uri, string $class): void;
}
