---
layout: default
title: Console Actions
parent: Testing
permalink: testing/console
---



# Console Actions

[`Centum\Codeception\Actions\ConsoleActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/ConsoleActions.php)



## `createTerminal`

```php
createTerminal(
    list<string> $argv
): Centum\Interfaces\Console\TerminalInterface
```



## `grabStdoutContent`

```php
grabStdoutContent(): string
```



## `grabStderrContent`

```php
grabStderrContent(): string
```



## `grabConsoleApplication`

```php
grabConsoleApplication(): Centum\Interfaces\Console\ApplicationInterface
```



## `addCommand`

```php
addCommand(
    class-string $commandClass
): void
```



## `runCommand`

```php
runCommand(
    list<string> $argv
): int
```



## `addConsoleExceptionHandler`

```php
addConsoleExceptionHandler(
    class-string $exceptionHandlerClass
): void
```



## `grabExitCode`

```php
grabExitCode(): int
```



## `seeExitCodeIs`

```php
seeExitCodeIs(
    int $expected
): void
```



## `seeExitCodeIsNot`

```php
seeExitCodeIsNot(
    int $expected
): void
```



## `seeStdoutEquals`

```php
seeStdoutEquals(
    string $expected
): void
```



## `seeStdoutNotEquals`

```php
seeStdoutNotEquals(
    string $expected
): void
```



## `seeStdoutContains`

```php
seeStdoutContains(
    string $expected
): void
```



## `seeStdoutNotContains`

```php
seeStdoutNotContains(
    string $expected
): void
```



## `seeStderrEquals`

```php
seeStderrEquals(
    string $expected
): void
```



## `seeStderrNotEquals`

```php
seeStderrNotEquals(
    string $expected
): void
```



## `seeStderrContains`

```php
seeStderrContains(
    string $expected
): void
```



## `seeStderrNotContains`

```php
seeStderrNotContains(
    string $expected
): void
```



## `grabCommandMetadata`

```php
grabCommandMetadata(
    class-string $commandClass
): Centum\Console\CommandMetadata
```



## `grabCommandName`

```php
grabCommandName(
    class-string $commandClass
): string
```



## `grabCommandDescription`

```php
grabCommandDescription(
    class-string $commandClass
): string
```
