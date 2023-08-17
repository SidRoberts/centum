---
layout: default
title: Forms Extension
parent: Twig
grand_parent: Components
permalink: twig/forms
nav_order: 3
---



# Forms

```php
use Centum\Twig\FormExtension;
use Twig\Environment;

/** @var Environment $twig */

$twig->addExtension(
    new FormExtension()
);
```

Within your Twig files, you can now use these functions:

* `form_start()` - open a new `<form>` tag.
* `form_end()` - close a `<form>` tag.

```twig
{% raw %}{{ form_start() }}

<input type="text" name="username">
<input type="password" name="password">

{{ form_end() }}{% endraw %}
```

`form_start()` can also be used to specify a HTTP method and an action URL:

```twig
{% raw %}{{ form_start("POST", "/login") }}

<input type="text" name="username">
<input type="password" name="password">

{{ form_end() }}{% endraw %}
```
