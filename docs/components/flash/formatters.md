---
layout: default
title: Formatters
parent: Flash
grand_parent: Components
---



# Formatters

Formatters determine how messages are outputted.
To create your own you must implement [`Centum\Flash\FormatterInterface`](https://github.com/SidRoberts/centum/blob/development/src/Flash/FormatterInterface.php).
Currently, there are two formatters:

## [`Centum\Flash\Formatter\HtmlFormatter`](https://github.com/SidRoberts/centum/blob/development/src/Flash/Formatter/HtmlFormatter.php)

```html
<div class="alert alert-danger">This is an example message.</div>
```

## [`Centum\Flash\Formatter\TextFormatter`](https://github.com/SidRoberts/centum/blob/development/src/Flash/Formatter/TextFormatter.php)

```
[DANGER] This is an example message.
```
