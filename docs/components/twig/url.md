---
layout: default
title: URL
parent: Twig
grand_parent: Components
permalink: twig/url
---



# URL Extension

**Before reading this, it may be prudent to first read about [Centum's URL component](../url/index.md).**

This extension provides a quick shortcut to the [`Centum\Url\Url`](https://github.com/SidRoberts/centum/blob/development/src/Url/Url.php) class in the form of a function.

First, the extension needs to be added to Twig:

```php
use Centum\Twig\UrlExtension;
use Centum\Url\Url;
use Twig\Environment;

/** @var string $baseUri */

$csrf = new Url($baseUri);

/** @var Environment $twig */

$twig->addExtension(
    new UrlExtension($csrf)
);
```

Then within your Twig files, you can call the `url()` function which will effectively call `$url->get()` to display all of the current flash messages:

```twig
<a href="{% raw %}{{ url('/link/to/a/page')|escape('html_attr') }}{% endraw %}">Link</a>
```
