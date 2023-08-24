---
layout: default
title: Router Actions
parent: Testing
permalink: testing/router
---



# Router Actions

[`Centum\Codeception\Actions\RouterActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/RouterActions.php)



## `grabRouter`

Grab the Router from the Container.

```php
grabRouter(): Centum\Interfaces\Router\RouterInterface
```



## `makeRouterGroup`

Make a new group of Routes with an optional middleware.

```php
makeRouterGroup(
    Centum\Interfaces\Router\MiddlewareInterface $middleware = null
): Centum\Interfaces\Router\GroupInterface
```



## `addRouterExceptionHandler`

Add an Exception Handler to the Router.

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

Grab the Response last created.

```php
grabResponse(): Centum\Interfaces\Http\ResponseInterface
```



## `grabResponseContent`

Grab the content from the Response last created.

```php
grabResponseContent(): string
```



## `seeResponseContentEquals`

```php
seeResponseContentEquals(
    string $expectedContent
): void
```



## `seeResponseContentContains`

```php
seeResponseContentContains(
    string $expectedContent
): void
```



## `grabResponseCode`

Grab the HTTP response code from the Response last created.

```php
grabResponseCode(): int
```



## `seeResponseCodeIs`

See if the HTTP response code is an expected value.

```php
seeResponseCodeIs(
    int $expectedCode
): void
```



## `seeResponseCodeIsNot`

See if the HTTP response code is NOT an expected value.

```php
seeResponseCodeIsNot(
    int $expectedCode
): void
```



## `seeResponseCodeIsSuccessful`

See if the HTTP response code is 2xx.

```php
seeResponseCodeIsSuccessful(): void
```



## `seeResponseCodeIsServerError`

See if the HTTP response code is 5xx.

```php
seeResponseCodeIsServerError(): void
```



## `seePageNotFound`

See if the HTTP response code is 404.

```php
seePageNotFound(): void
```
