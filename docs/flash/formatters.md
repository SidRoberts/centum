---
layout: default
title: Formatters
parent: Flash Component
permalink: flash/formatters
nav_order: 1
---



# Formatters

Formatters determine how messages are outputted.

{: .callout.info }
Formatters must implement [`Centum\Interfaces\Flash\FormatterInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Flash/FormatterInterface.php).

Currently, there are 2 formatters:



## [`HtmlFormatter`](https://github.com/SidRoberts/centum/blob/main/src/Flash/Formatter/HtmlFormatter.php)

```html
<div class="alert alert-danger">This is an example message.</div>
```



## [`TextFormatter`](https://github.com/SidRoberts/centum/blob/main/src/Flash/Formatter/TextFormatter.php)

```text
[DANGER] This is an example message.
```
