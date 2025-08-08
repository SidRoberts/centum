---
layout: default
title: Input / Output
parent: Console
grand_parent: Components
permalink: console/input-output
nav_order: 2
---



# Input / Output

The [`Centum\Console\Terminal`](https://github.com/SidRoberts/centum/blob/development/src/Console/Terminal.php) provides a simple interface for interacting with the terminal, handling both input and output.
By default, it reads from `STDIN` and writes to `STDOUT` and `STDERR`.



## Constructor

```php
Centum\Console\Terminal(
    Centum\Interfaces\Console\Terminal\ArgumentsInterface $arguments,
    resource $stdin = STDIN,
    resource $stdout = STDOUT,
    resource $stderr = STDERR
);
```

{: .highlight }
[`Centum\Console\Terminal`](https://github.com/SidRoberts/centum/blob/development/src/Console/Terminal.php) implements [`Centum\Interfaces\Console\TerminalInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Console/TerminalInterface.php).



## Example: Creating a Terminal

```php
use Centum\Console\Terminal;
use Centum\Interfaces\Console\Terminal\ArgumentsInterface;

/** @var ArgumentsInterface $arguments */

$terminal = new Terminal($arguments);
```



## Input

### Accessing Arguments

Retrieve CLI arguments passed to your command:

```php
$arguments = $terminal->getArguments();
```

You can then access individual arguments or options as needed.



## Output

### Writing to STDOUT

```php
$terminal->write("hello");     // Writes without newline
$terminal->writeLine("hello"); // Writes with newline
```

### Writing to STDERR

```php
$terminal->writeError("error");     // Writes error message without newline
$terminal->writeErrorLine("error"); // Writes error message with newline
```
