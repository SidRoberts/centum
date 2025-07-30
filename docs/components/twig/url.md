---
layout: default
title: URL Extension
parent: Twig
grand_parent: Components
permalink: twig/url
nav_order: 4
---



# URL Extension

**Before reading this, it may be prudent to first read about [Centum's URL component](../url/index.md).**

This extension provides a shortcut to the [`Centum\Url\Url`](https://github.com/SidRoberts/centum/blob/development/src/Url/Url.php) class in Twig templates in the form of a function.



## Functions

- `url(string $uri = "", array $arguments = [])`



## Usage

First, the extension needs to be added to Twig:

```php
use Centum\Twig\UrlExtension;
use Centum\Url\Url;
use Twig\Environment;

/** @var string $baseUri */

$url = new Url($baseUri);

/** @var Environment $twig */

$twig->addExtension(
    new UrlExtension($url)
);
```

Then within your Twig files, you can call the `url()` function which will effectively call `$url->get()` to display all of the current flash messages:

```twig
<a href="{% raw %}{{ url('/link/to/a/page')|escape('html_attr') }}{% endraw %}">Link</a>
```
