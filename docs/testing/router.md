---
layout: default
title: Router Actions
parent: Testing
permalink: testing/router
---



# Router Actions

[`Centum\Codeception\Actions\RouterActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/RouterActions.php)



## `grabRouter`

```php
grabRouter(): Centum\Interfaces\Router\RouterInterface
```



## `makeRouterGroup`

```php
makeRouterGroup(
    Centum\Interfaces\Router\MiddlewareInterface $middleware = null
): Centum\Interfaces\Router\GroupInterface
```



## `addRouterExceptionHandler`

```php
addRouterExceptionHandler(
    class-string $exceptionHandlerClass
): void
```



## `startFollowingRedirects`

```php
startFollowingRedirects(): void
```



## `stopFollowingRedirects`

```php
stopFollowingRedirects(): void
```



## `seeRouteExists`

```php
seeRouteExists(
    Centum\Interfaces\Http\RequestInterface $request
): void
```



## `seeRouteNotFound`

```php
seeRouteNotFound(
    Centum\Interfaces\Http\RequestInterface $request
): void
```



## `amOnPage`

```php
amOnPage(
    string $uri,
    array<string, mixed> $params = []
): void
```



## `handleRequest`

```php
handleRequest(
    Centum\Interfaces\Http\RequestInterface $request
): Centum\Interfaces\Http\ResponseInterface
```



## `followRedirect`

```php
followRedirect(): Centum\Interfaces\Http\ResponseInterface
```



## `grabCurrentUri`

```php
grabCurrentUri(): string
```



## `seeCurrentUriEquals`

```php
seeCurrentUriEquals(
    string $expectedUri
): void
```



## `grabResponse`

```php
grabResponse(): Centum\Interfaces\Http\ResponseInterface
```



## `grabResponseContent`

```php
grabResponseContent(): string
```



## `seeResponseContentEquals`

```php
seeResponseContentEquals(
    string $expected
): void
```



## `seeResponseContentContains`

```php
seeResponseContentContains(
    string $expected
): void
```



## `grabResponseCode`

```php
grabResponseCode(): int
```



## `seeResponseCodeIs`

```php
seeResponseCodeIs(
    int $expected
): void
```



## `seeResponseCodeIsNot`

```php
seeResponseCodeIsNot(
    int $expected
): void
```



## `seeResponseCodeIsSuccessful`

```php
seeResponseCodeIsSuccessful(): void
```



## `seeResponseCodeIsServerError`

```php
seeResponseCodeIsServerError(): void
```



## `seePageNotFound`

```php
seePageNotFound(): void
```
