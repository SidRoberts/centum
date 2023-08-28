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
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function get(string $uri, string $class, string $method): RouteInterface;

    /**
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function post(string $uri, string $class, string $method): RouteInterface;

    /**
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function head(string $uri, string $class, string $method): RouteInterface;

    /**
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function put(string $uri, string $class, string $method): RouteInterface;

    /**
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function delete(string $uri, string $class, string $method): RouteInterface;

    /**
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function trace(string $uri, string $class, string $method): RouteInterface;

    /**
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function options(string $uri, string $class, string $method): RouteInterface;

    /**
     * @param class-string<ControllerInterface> $class
     * @param non-empty-string $method
     */
    public function connect(string $uri, string $class, string $method): RouteInterface;

    /**
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
