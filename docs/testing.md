---
layout: default
title: Testing
nav_order: 5
---



# Testing

Centum uses [Codeception](https://codeception.com/) for most of its testing and utilises its own module ([`Centum\Codeception\Module`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Module.php)) to further enhance Codeception's abilities.

This module is already enabled in [SidRoberts/centum-project](https://github.com/SidRoberts/centum-project).
You can also enable it in your own projects:

```yaml
modules:
  enabled:
    - Centum\Codeception\Module:
        container: config/container.php
```

Currently, the only config setting is `container` which should link to a file that returns a [Container](components/container/index.md) object.
If this isn't specified, it will default to `config/container.php`.



## General Testing

- `getContainer(): Centum\Interfaces\Container\ContainerInterface`
- `addToContainer(string $class, object $object): void`

### Expectations

- `expectEcho(string $expected, callable $callable): void`



## Console Testing

- `createTerminal(array $argv): Centum\Console\Terminal`
- `getStdoutContent(): string`
- `getStderrContent(): string`
- `getConsoleApplication(): Centum\Console\Application`
- `addCommand(Centum\Console\CommandInterface $command): void`
- `runCommand(array $argv): int`

### Assertions

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



## Web Testing

...
