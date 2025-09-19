---
layout: default
title: Flash Extension
parent: Twig Component
permalink: twig/flash
nav_order: 2
---



# Flash Extension

**Before reading this, it may be prudent to first read about [Centum's Flash component](../flash/index.md).**

This extension provides a quick shortcut to the [Flash component](../flash/index.md) in the form of a function.



## Functions

- `flash()`



## Usage

First, the extension needs to be added to Twig:

```php
use Centum\Interfaces\Flash\FlashInterface;
use Centum\Twig\FlashExtension;
use Twig\Environment;

/**
 * @var Environment $twig
 * @var FlashInterface $flash
 */

$twig->addExtension(
    new FlashExtension($flash)
);
```

Then within your Twig files, you can call the `flash()` function which will effectively call `$flash->output()` to display all of the current flash messages:

```twig
{% raw %}{{ flash() }}{% endraw %}
```
