---
layout: default
title: Testing
nav_order: 5
---



# Testing

Centum uses [Codeception](https://codeception.com/) for most of its testing and utilises its own module ([`Centum\Codeception\Module`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Module.php)) to enable tests to use a centralised [Container](components/container/index.md) object.

This module is already enabled in [SidRoberts/centum-project](https://github.com/SidRoberts/centum-project).
You can also enable it in your own projects:

```yaml
modules:
  enabled:
    - Centum\Codeception\Module:
        container: config/container.php
```

Currently, the only config setting is `container` which should link to a file that returns a [`Centum\Interfaces\Container\ContainerInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Container/ContainerInterface.php) object.
If this isn't specified, it will default to `config/container.php`.

This module is kept as simple as possible so that it can work with all kinds of tests.
To futher enhance testing, these traits are available:

- [`Centum\Codeception\Actions\AjaxActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/AjaxActions.php)
- [`Centum\Codeception\Actions\ConsoleActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/ConsoleActions.php)
- [`Centum\Codeception\Actions\HtmlActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/HtmlActions.php)
- [`Centum\Codeception\Actions\JsonActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/JsonActions.php)
- [`Centum\Codeception\Actions\RouterActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/RouterActions.php)
- [`Centum\Codeception\Actions\SessionActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/SessionActions.php)
- [`Centum\Codeception\Actions\TaskActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/TaskActions.php)
- [`Centum\Codeception\Actions\UnitTestActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/UnitTestActions.php)
- [`Centum\Codeception\Actions\ValidatorActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/ValidatorActions.php)

These traits can be used at will in your Tester classes (`tests/Support/UnitTester.php`, for example).



## [`Centum\Codeception\Module`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Module.php)

- `grabContainer(): Centum\Interfaces\Container\ContainerInterface`
- `addToContainer(string $class, object $object): void`
- `grabFromContainer(class-string $class): object`
- `mock(class-string $class, callable $callable = null): Mockery\MockInterface`
- `mockInContainer(class-string $class, callable $callable = null): Mockery\MockInterface`



## [`Centum\Codeception\Actions\AjaxActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/AjaxActions.php)

- `sendAjaxRequest(string $method, string $uri, array $data = []): void`
- `sendAjaxGetRequest(string $uri, array $data = []): void`
- `sendAjaxPostRequest(string $uri, array $data = []): void`



## [`Centum\Codeception\Actions\ConsoleActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/ConsoleActions.php)

- `createTerminal(array $argv): Centum\Interfaces\Console\TerminalInterface`
- `grabStdoutContent(): string`
- `grabStderrContent(): string`
- `grabConsoleApplication(): Centum\Interfaces\Console\ApplicationInterface`
- `addCommand(Centum\Interfaces\Console\CommandInterface $command): void`
- `runCommand(array $argv): int`
- `seeExitCodeIs(int $exitCode, string $message = ""): void`
- `seeExitCodeIsNot(int $exitCode, string $message = ""): void`
- `seeStdoutEquals(string $expected, string $message = ""): void`
- `seeStdoutNotEquals(string $expected, string $message = ""): void`
- `seeStdoutContains(string $expected, string $message = ""): void`
- `seeStdoutNotContains(string $expected, string $message = ""): void`
- `seeStderrEquals(string $expected, string $message = ""): void`
- `seeStderrNotEquals(string $expected, string $message = ""): void`
- `seeStderrContains(string $expected, string $message = ""): void`
- `seeStderrNotContains(string $expected, string $message = ""): void`



## [`Centum\Codeception\Actions\HtmlActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/HtmlActions.php)

- `grabTextContent(): string`
- `submitForm(string $id, array $data = []): void`
- `see(string $needle): void`
- `dontSee(string $needle): void`
- `seeInSource(string $needle): void`
- `dontSeeInSource(string $needle): void`
- `seeInPageTitle(string $needle): void`
- `dontSeeInPageTitle(string $needle): void`
- `grabPageTitle(): string`
- `seeElement(string $id): void`
- `dontSeeElement(string $id): void`
- `grabElement(string $id): DOMElement|null`



## [`Centum\Codeception\Actions\JsonActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/JsonActions.php)

- `seeResponseIsJson(): void`



## [`Centum\Codeception\Actions\RouterActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/RouterActions.php)

- `grabRouter(): Centum\Interfaces\Router\RouterInterface`
- `makeRouterGroup(Centum\Interfaces\Router\MiddlewareInterface $middleware = null): GroupInterface`
- `startFollowingRedirects(): void`
- `stopFollowingRedirects(): void`
- `seeRouteExists(Centum\Interfaces\Http\RequestInterface $request, string $message = ""): void`
- `seeRouteNotFound(Centum\Interfaces\Http\RequestInterface $request, string $message = ""): void`
- `amOnPage(string $uri): void`
- `handleRequest(Centum\Interfaces\Http\RequestInterface $request): Centum\Interfaces\Http\ResponseInterface`
- `followRedirect(): Centum\Interfaces\Http\ResponseInterface`
- `grabResponseContent(): string`
- `seeResponseContentEquals(string $expected): void`
- `seeResponseContentContains(string $expected): void`
- `seeResponseCodeIs(int $expected, string $message = ""): void`
- `seeResponseCodeIsNot(int $expected, string $message = ""): void`
- `seeResponseCodeIsSuccessful(string $message = ""): void`
- `seePageNotFound(string $message = ""): void`



## [`Centum\Codeception\Actions\SessionActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/SessionActions.php)

- `grabSession(): Centum\Interfaces\Http\SessionInterface`
- `seeInSession(string $key): void`
- `dontSeeInSession(string $key): void`
- `grabFromSession(string $key, mixed $defaultValue = null): mixed`
- `removeFromSession(string $key): mixed`



## [`Centum\Codeception\Actions\TaskActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/TaskActions.php)

- `executeTask(Centum\Interfaces\Queue\TaskInterface $task): void`



## [`Centum\Codeception\Actions\UnitTestActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/UnitTestActions.php)

- `grabEchoContent(callable $callable): string`
- `expectEcho(string $expected, callable $callable): void`



## [`Centum\Codeception\Actions\ValidatorActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/ValidatorActions.php)

- `seeValidatorPasses(Centum\Interfaces\Validator\ValidatorInterface, mixed $value): void`
- `seeValidatorFails(Centum\Interfaces\Validator\ValidatorInterface, mixed $value, array $expectedViolations = null): void`
