---
layout: default
title: Input / Output
parent: Console
grand_parent: Components
permalink: console/input-output
nav_order: 2
---



# Input / Output

The [`Centum\Console\Terminal`](https://github.com/SidRoberts/centum/blob/development/src/Console/Terminal.php) makes it easy to interact with the Terminal, both in terms of input and output.
By default, it uses `$_SERVER["argv"]` and reads and writes to `STDIN`, `STDOUT`, and `STDERR`.

```php
Centum\Console\Terminal(
    array $argv = $_SERVER["argv"],
    resource $stdin = STDIN,
    resource $stdout = STDOUT,
    resource $stderr = STDERR
);
```

{: .highlight }
[`Centum\Console\Terminal`](https://github.com/SidRoberts/centum/blob/development/src/Console/Terminal.php) implements [`Centum\Interfaces\Console\TerminalInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Console/TerminalInterface.php).

```php
use Centum\Console\Terminal;

$terminal = new Terminal();
```



## Input

### Getting `$argv`

```php
$terminal->getArgv();
```



## Output

### Writing to the Terminal

(to `STDOUT`)

```php
$terminal->write("hello");
```

```php
$terminal->writeLine("hello");
```

### Error messages

(to `STDERR`)

```php
$terminal->writeError("hello");
```

```php
$terminal->writeErrorLine("hello");
```



### Displaying a list

```php
$terminal->writeList(
    [
        "Item 1",
        "Item 2",
        "Item 3",
    ]
);
```
