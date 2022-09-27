<?php

namespace Centum\Interfaces\Router;

interface GroupInterface
{
    public function getMiddleware(): MiddlewareInterface;

    /**
     * @return RouteInterface[]
     */
    public function getRoutes(): array;



    /**
     * @param class-string $class
     */
    public function get(string $uri, string $class, string $method): RouteInterface;

    /**
     * @param class-string $class
     */
    public function post(string $uri, string $class, string $method): RouteInterface;

    /**
     * @param class-string $class
     */
    public function head(string $uri, string $class, string $method): RouteInterface;

    /**
     * @param class-string $class
     */
    public function put(string $uri, string $class, string $method): RouteInterface;

    /**
     * @param class-string $class
     */
    public function delete(string $uri, string $class, string $method): RouteInterface;

    /**
     * @param class-string $class
     */
    public function trace(string $uri, string $class, string $method): RouteInterface;

    /**
     * @param class-string $class
     */
    public function options(string $uri, string $class, string $method): RouteInterface;

    /**
     * @param class-string $class
     */
    public function connect(string $uri, string $class, string $method): RouteInterface;

    /**
     * @param class-string $class
     */
    public function patch(string $uri, string $class, string $method): RouteInterface;



    /**
     * @param class-string $class
     */
    public function crud(string $uri, string $class): void;

    /**
     * @param class-string $class
     */
    public function submission(string $uri, string $class): void;
}