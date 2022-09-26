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
use Centum\Interfaces\Http\SessionInterface;
use Centum\Twig\CsrfExtension;
use Twig\Environment;

/** @var SessionInterface $session */

$csrf = new Csrf($session);

/** @var Environment $twig */

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
