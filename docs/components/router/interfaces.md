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



## [`Centum\Interfaces\Router\ControllerInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Router/ControllerInterface.php)

No methods.



## [`Centum\Interfaces\Router\ExceptionHandlerInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Router/ExceptionHandlerInterface.php)

```php
handle(
    Centum\Interfaces\Http\RequestInterface $request,
    Throwable $throwable
): Centum\Interfaces\Http\ResponseInterface
```



## [`Centum\Interfaces\Router\GroupInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Router/GroupInterface.php)

```php
getMiddleware(): Centum\Interfaces\Router\MiddlewareInterface
```

```php
getRoutes(): list<Centum\Interfaces\Router\RouteInterface>
```

```php
get(
    string $uri,
    class-string<Centum\Interfaces\Router\ControllerInterface> $class,
    non-empty-string $method
): Centum\Interfaces\Router\RouteInterface
```

```php
post(
    string $uri,
    class-string<Centum\Interfaces\Router\ControllerInterface> $class,
    non-empty-string $method
): Centum\Interfaces\Router\RouteInterface
```

```php
head(
    string $uri,
    class-string<Centum\Interfaces\Router\ControllerInterface> $class,
    non-empty-string $method
): Centum\Interfaces\Router\RouteInterface
```

```php
put(
    string $uri,
    class-string<Centum\Interfaces\Router\ControllerInterface> $class,
    non-empty-string $method
): Centum\Interfaces\Router\RouteInterface
```

```php
delete(
    string $uri,
    class-string<Centum\Interfaces\Router\ControllerInterface> $class,
    non-empty-string $method
): Centum\Interfaces\Router\RouteInterface
```

```php
trace(
    string $uri,
    class-string<Centum\Interfaces\Router\ControllerInterface> $class,
    non-empty-string $method
): Centum\Interfaces\Router\RouteInterface
```

```php
options(
    string $uri,
    class-string<Centum\Interfaces\Router\ControllerInterface> $class,
    non-empty-string $method
): Centum\Interfaces\Router\RouteInterface
```

```php
connect(
    string $uri,
    class-string<Centum\Interfaces\Router\ControllerInterface> $class,
    non-empty-string $method
): Centum\Interfaces\Router\RouteInterface
```

```php
patch(
    string $uri,
    class-string<Centum\Interfaces\Router\ControllerInterface> $class,
    non-empty-string $method
): Centum\Interfaces\Router\RouteInterface
```

```php
crud(
    string $uri,
    class-string<Centum\Interfaces\Router\ControllerInterface> $class
): void
```

```php
submission(
    string $uri,
    class-string<Centum\Interfaces\Router\ControllerInterface> $class
): void
```



## [`Centum\Interfaces\Router\MiddlewareInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Router/MiddlewareInterface.php)

```php
check(
    Centum\Interfaces\Http\RequestInterface $request
): bool
```



## [`Centum\Interfaces\Router\ParametersInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Router/ParametersInterface.php)

```php
get(
    non-empty-string $name,
    mixed $defaultValue = null
): mixed
```

```php
has(
    non-empty-string $name
): bool
```

```php
toArray(): array<non-empty-string, mixed>
```



## [`Centum\Interfaces\Router\ReplacementInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Router/ReplacementInterface.php)

```php
getIdentifier(): non-empty-string
```

```php
getRegularExpression(): non-empty-string
```

```php
filter(
    string $value
): mixed
```



## [`Centum\Interfaces\Router\RouteInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Router/RouteInterface.php)

```php
getHttpMethod(): non-empty-string
```

```php
getUri(): string
```

```php
getClass(): class-string<Centum\Interfaces\Router\ControllerInterface>
```

```php
getMethod(): non-empty-string
```

```php
getParameters(): array<non-empty-string, string>
```



## [`Centum\Interfaces\Router\RouterInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Router/RouterInterface.php)

```php
group(
    Centum\Interfaces\Router\MiddlewareInterface $middleware = null
): Centum\Interfaces\Router\GroupInterface
```

```php
addExceptionHandler(
    class-string<Centum\Interfaces\Router\ExceptionHandlerInterface> $exceptionHandlerClass
): void
```

```php
handle(
    Centum\Interfaces\Http\RequestInterface $request
): Centum\Interfaces\Http\ResponseInterface
```
