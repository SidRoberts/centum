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

Grab the Console Application from the Container.

```php
grabConsoleApplication(): Centum\Interfaces\Console\ApplicationInterface
```



## `addCommand`

Add a Command to the Console Application.

```php
addCommand(
    class-string<Centum\Interfaces\Console\CommandInterface> $commandClass
): void
```



## `runCommand`

```php
runCommand(
    list<string> $argv
): int
```



## `addConsoleExceptionHandler`

Add an Exception Handler to the Console Application.

```php
addConsoleExceptionHandler(
    class-string<Centum\Interfaces\Console\ExceptionHandlerInterface> $exceptionHandlerClass
): void
```



## `grabExitCode`

```php
grabExitCode(): int
```



## `seeExitCodeIs`

```php
seeExitCodeIs(
    int $expectedCode
): void
```



## `seeExitCodeIsNot`

```php
seeExitCodeIsNot(
    int $expectedCode
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
    class-string<Centum\Interfaces\Console\CommandInterface> $commandClass
): Centum\Console\CommandMetadata
```



## `grabCommandName`

```php
grabCommandName(
    class-string<Centum\Interfaces\Console\CommandInterface> $commandClass
): string
```



## `grabCommandDescription`

```php
grabCommandDescription(
    class-string<Centum\Interfaces\Console\CommandInterface> $commandClass
): string
```



## `seeCommandNameIs`

```php
seeCommandNameIs(
    class-string<Centum\Interfaces\Console\CommandInterface> $commandClass,
    string $expectedName
): void
```



## `seeCommandDescriptionIs`

```php
seeCommandDescriptionIs(
    class-string<Centum\Interfaces\Console\CommandInterface> $commandClass,
    string $expectedName
): void
```
