---
layout: default
title: CSRF
parent: Twig
grand_parent: Components
permalink: twig/csrf
---



# CSRF Extension

**Before reading this, it may be prudent to first read about [Centum's CSRF Protection](../http/forms.md#csrf-protection).**

This extension provides a quick shortcut to the [`Centum\Http\Csrf`](https://github.com/SidRoberts/centum/blob/development/src/Http/Csrf.php) class in the form of a function.

First, the extension needs to be added to Twig:

```php
use Centum\Http\Csrf;
use Centum\Http\Session;
use Centum\Twig\CsrfExtension;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/** @var Session $session */

$csrf = new Csrf($session);

$loader = new FilesystemLoader("resources/twig/");

$twig = new Environment($loader);

$twig->addExtension(
    new CsrfExtension($csrf)
);
```

Then within your Twig files, you can call the `csrf()` function within a form which will create a hidden `<input>` with a CSRF token as its value:

```twig
<form>
    {% raw %}{{ csrf() }}{% endraw %}

    <!-- rest of the form -->
</form>
```
