---
layout: default
title: Router Actions
parent: Testing
permalink: testing/router
---



# Router Actions

[`Centum\Codeception\Actions\RouterActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/RouterActions.php)

- `grabRouter(): Centum\Interfaces\Router\RouterInterface`
- `makeRouterGroup(Centum\Interfaces\Router\MiddlewareInterface $middleware = null): GroupInterface`
- `startFollowingRedirects(): void`
- `stopFollowingRedirects(): void`
- `seeRouteExists(Centum\Interfaces\Http\RequestInterface $request, string $message = ""): void`
- `seeRouteNotFound(Centum\Interfaces\Http\RequestInterface $request, string $message = ""): void`
- `amOnPage(string $uri, array $params): void`
- `handleRequest(Centum\Interfaces\Http\RequestInterface $request): Centum\Interfaces\Http\ResponseInterface`
- `followRedirect(): Centum\Interfaces\Http\ResponseInterface`
- `grabCurrentUri(): string`
- `seeCurrentUriEquals(string $uri): void`
- `grabResponseContent(): string`
- `seeResponseContentEquals(string $expected): void`
- `seeResponseContentContains(string $expected): void`
- `grabResponseCode(): int`
- `seeResponseCodeIs(int $expected, string $message = ""): void`
- `seeResponseCodeIsNot(int $expected, string $message = ""): void`
- `seeResponseCodeIsSuccessful(string $message = ""): void`
- `seeResponseCodeIsServerError(string $message = ""): void`
- `seePageNotFound(string $message = ""): void`
