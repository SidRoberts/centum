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
To futher improve testing in specific suites, these classes are used:

- [`Tests\Support\ConsoleTester`](https://github.com/SidRoberts/centum/blob/development/tests/Support/ConsoleTester.php)
- [`Tests\Support\UnitTester`](https://github.com/SidRoberts/centum/blob/development/tests/Support/UnitTester.php)
- [`Tests\Support\WebTester`](https://github.com/SidRoberts/centum/blob/development/tests/Support/WebTester.php)



## [`Centum\Codeception\Module`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Module.php)

- `getContainer(): Centum\Interfaces\Container\ContainerInterface`
- `addToContainer(string $class, object $object): void`
- `getFromContainer(class-string $class): object`

### Mocking

- `mock(class-string $class, callable $callable = null): Mockery\MockInterface`
- `mockInContainer(class-string $class, callable $callable = null): Mockery\MockInterface`



## [`Tests\Support\UnitTester`](https://github.com/SidRoberts/centum/blob/development/tests/Support/UnitTester.php)

- `getEchoContent(callable $callable): string`
- `executeTask(Centum\Interfaces\Queue\TaskInterface $task): void`

### Expectations

- `expectEcho(string $expected, callable $callable): void`



## [`Tests\Support\ConsoleTester`](https://github.com/SidRoberts/centum/blob/development/tests/Support/ConsoleTester.php)

- `createTerminal(array $argv): Centum\Interfaces\Console\TerminalInterface`
- `getStdoutContent(): string`
- `getStderrContent(): string`
- `getConsoleApplication(): Centum\Interfaces\Console\ApplicationInterface`
- `addCommand(Centum\Interfaces\Console\CommandInterface $command): void`
- `runCommand(array $argv): int`

### Assertions

- `assertExitCodeIs(int $exitCode, string $message = ""): void`
- `assertExitCodeIsNot(int $exitCode, string $message = ""): void`

#### STDOUT

- `assertStdoutEquals(string $expected, string $message = ""): void`
- `assertStdoutNotEquals(string $expected, string $message = ""): void`
- `assertStdoutContains(string $expected, string $message = ""): void`
- `assertStdoutNotContains(string $expected, string $message = ""): void`

#### STDERR

- `assertStderrEquals(string $expected, string $message = ""): void`
- `assertStderrNotEquals(string $expected, string $message = ""): void`
- `assertStderrContains(string $expected, string $message = ""): void`
- `assertStderrNotContains(string $expected, string $message = ""): void`



## [`Tests\Support\WebTester`](https://github.com/SidRoberts/centum/blob/development/tests/Support/WebTester.php)

...
