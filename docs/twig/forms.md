---
layout: default
title: Forms
parent: Twig
---



# Forms

```php
use Centum\Twig\FormExtension;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader("views/");

$twig = new Environment($loader);

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
