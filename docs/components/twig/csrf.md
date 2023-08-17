---
layout: default
title: CSRF Extension
parent: Twig
grand_parent: Components
permalink: twig/csrf
nav_order: 1
---



# CSRF Extension

**Before reading this, it may be prudent to first read about [Centum's CSRF component](../http/csrf.md).**

This extension provides a quick shortcut to the [`Centum\Interfaces\Http\Csrf\StorageInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/Csrf/StorageInterface.php) interface in the form of a function.

First, the extension needs to be added to Twig:

```php
use Centum\Interfaces\Http\Csrf\StorageInterface;
use Centum\Twig\CsrfExtension;
use Twig\Environment;

/** @var Environment $twig */

/** @var StorageInterface $csrfStorage */

$twig->addExtension(
    new CsrfExtension($csrfStorage)
);
```

Then within your Twig files, you can call the `csrf()` function within a form which will create a hidden `<input>` with a CSRF token as its value:

```twig
<form>
    {% raw %}{{ csrf() }}{% endraw %}

    <!-- rest of the form -->
</form>
```

This extension also provides the `csrfValue()` function that returns the raw CSRF value which is useful when dealing with AJAX form submissions:

```js
$.post(
    {
        url: "/update-password",
        data: {
            "newPassword":        $("#newPassword").val(),
            "newPasswordConfirm": $("#newPasswordConfirm").val(),
            "csrf":               "{% raw %}{{ csrfValue() }}{% endraw %}"
        }
    }
);
```
