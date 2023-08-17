---
layout: default
title: Interfaces
parent: Router
grand_parent: Components
permalink: router/interfaces
nav_order: 102
---



# Interfaces

(all in the `Centum\Interfaces\Router` namespace)



## [`Centum\Interfaces\Router\ControllerInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Router/ControllerInterface.php)



## [`Centum\Interfaces\Router\ExceptionHandlerInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Router/ExceptionHandlerInterface.php)

- `handle(Centum\Interfaces\Http\RequestInterface $request, Throwable $throwable): Centum\Interfaces\Http\ResponseInterface`



## [`Centum\Interfaces\Router\GroupInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Router/GroupInterface.php)

- `getMiddleware(): Centum\Interfaces\Router\MiddlewareInterface`
- `getRoutes(): array`
- `get(string $uri, string $class, string $method): Centum\Interfaces\Router\RouteInterface`
- `post(string $uri, string $class, string $method): Centum\Interfaces\Router\RouteInterface`
- `head(string $uri, string $class, string $method): Centum\Interfaces\Router\RouteInterface`
- `put(string $uri, string $class, string $method): Centum\Interfaces\Router\RouteInterface`
- `delete(string $uri, string $class, string $method): Centum\Interfaces\Router\RouteInterface`
- `trace(string $uri, string $class, string $method): Centum\Interfaces\Router\RouteInterface`
- `options(string $uri, string $class, string $method): Centum\Interfaces\Router\RouteInterface`
- `connect(string $uri, string $class, string $method): Centum\Interfaces\Router\RouteInterface`
- `patch(string $uri, string $class, string $method): Centum\Interfaces\Router\RouteInterface`
- `crud(string $uri, string $class): void`
- `submission(string $uri, string $class): void`



## [`Centum\Interfaces\Router\MiddlewareInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Router/MiddlewareInterface.php)

- `middleware(Centum\Interfaces\Http\RequestInterface $request): bool`



## [`Centum\Interfaces\Router\ParametersInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Router/ParametersInterface.php)

- `get(string $name, mixed $defaultValue = null): mixed`
- `has(string $name): bool`
- `toArray(): array`



## [`Centum\Interfaces\Router\ReplacementInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Router/ReplacementInterface.php)

- `getIdentifier(): string`
- `getRegularExpression(): string`
- `filter(string $value): mixed`



## [`Centum\Interfaces\Router\RouteInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Router/RouteInterface.php)

- `getHttpMethod(): string`
- `getUri(): string`
- `getClass(): string`
- `getMethod(): string`
- `getParameters(): array`



## [`Centum\Interfaces\Router\RouterInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Router/RouterInterface.php)

- `group(Centum\Interfaces\Router\MiddlewareInterface $middleware = null): Centum\Interfaces\Router\GroupInterface`
- `addExceptionHandler(string $exceptionHandlerClass): void`
- `handle(Centum\Interfaces\Http\RequestInterface $request): Centum\Interfaces\Http\ResponseInterface`
