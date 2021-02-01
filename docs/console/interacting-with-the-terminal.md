---
layout: default
title: Interacting With the Terminal
parent: Console
nav_order: 2
---



The [`Centum\Console\Terminal`](https://github.com/SidRoberts/centum/blob/development/src/Console/Terminal.php) makes it easy to interact with the Terminal, both in terms of input and output.
By default, it uses `$_SERVER["argv"]` and reads and writes to `STDIN`, `STDOUT`, and `STDERR`.


```php
use Centum\Console\Terminal;

$terminal = new Terminal();
```
