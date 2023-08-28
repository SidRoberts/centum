---
layout: default
title: Interfaces
parent: Console
grand_parent: Components
permalink: console/interfaces
nav_order: 102
---



# Interfaces

(all in the `Centum\Interfaces\Console` namespace)



## [`Centum\Interfaces\Console\ApplicationInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Console/ApplicationInterface.php)

```php
addCommand(
    class-string<Centum\Interfaces\Console\CommandInterface> $commandClass
): void
```

```php
getCommands(): array<string, class-string<Centum\Interfaces\Console\CommandInterface>>
```

```php
addExceptionHandler(
    class-string<Centum\Interfaces\Console\ExceptionHandlerInterface> $exceptionHandlerClass
): void
```

```php
handle(
    Centum\Interfaces\Console\TerminalInterface $terminal
): int
```



## [`Centum\Interfaces\Console\CommandInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Console/CommandInterface.php)

```php
execute(
    Centum\Interfaces\Console\TerminalInterface $terminal
): int
```



## [`Centum\Interfaces\Console\ExceptionHandlerInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Console/ExceptionHandlerInterface.php)

```php
handle(
    Centum\Interfaces\Console\TerminalInterface $terminal,
    Throwable $throwable
): void
```



## [`Centum\Interfaces\Console\TerminalInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Console/TerminalInterface.php)

```php
getArguments(): Centum\Interfaces\Console\Terminal\ArgumentsInterface
```

```php
getStdIn(): resource
```

```php
getStdOut(): resource
```

```php
getStdErr(): resource
```

```php
write(
    string $string
): void
```

```php
writeLine(
    string $string = ""
): void
```

```php
writeList(
    array<string> $list
): void
```

```php
writeError(
    string $string
): void
```

```php
writeErrorLine(
    string $string = ""
): void
```



## [`Centum\Interfaces\Console\Terminal\ArgumentsInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Console/Terminal/ArgumentsInterface.php)

```php
getFilename(): string
```

```php
getCommandName(): string
```

```php
getParameters(): array<non-empty-string, string|bool>
```

```php
getParameter(
    non-empty-string $name,
    mixed $defaultValue = null
): mixed
```

```php
hasParameter(
    non-empty-string $name
): bool
```

```php
toArray(): array<string>
```
