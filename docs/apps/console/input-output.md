---
layout: default
title: Input / Output
parent: Console
grand_parent: Apps
nav_order: 2
---



# Input / Output

The [`Centum\Console\Terminal`](https://github.com/SidRoberts/centum/blob/development/src/Console/Terminal.php) makes it easy to interact with the Terminal, both in terms of input and output.
By default, it uses `$_SERVER["argv"]` and reads and writes to `STDIN`, `STDOUT`, and `STDERR`.

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

```php
$terminal->write("hello");
```

```php
$terminal->writeLine("hello");
```

### Error messages

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
