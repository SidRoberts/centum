---
layout: default
title: Flash
parent: Twig
grand_parent: Components
permalink: twig/flash
---



# Flash Extension

**Before reading this, it may be prudent to first read about [Centum's Flash component](../flash/index.md).**

This extension provides a quick shortcut to the [`Centum\Flash\Flash`](https://github.com/SidRoberts/centum/blob/development/src/Flash/Flash.php) class in the form of a function.

First, the extension needs to be added to Twig:

```php
use Centum\Flash\Flash;
use Centum\Flash\FormatterInterface;
use Centum\Http\Session;
use Centum\Twig\FlashExtension;
use Twig\Environment;

/** @var Session $session */
/** @var FormatterInterface $formatter */

$flash = new Flash($session, $formatter);

/** @var Environment $twig */

$twig->addExtension(
    new FlashExtension($flash)
);
```

Then within your Twig files, you can call the `flash()` function which will effectively call `$flash->output()` to display all of the current flash messages:

```twig
{{ flash() }}
```