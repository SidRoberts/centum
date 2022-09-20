---
layout: default
title: Forms
parent: Http
grand_parent: Components
permalink: http/forms
---



# Forms

```php
Centum\Http\Form(
    Centum\Http\Request $request,
    Centum\Http\Csrf $csrf,
    Centum\Container\Container $container
);
```

...



## CSRF Protection

[`Centum\Http\Csrf`](https://github.com/SidRoberts/centum/blob/development/src/Http/Csrf.php) exists to prevent [cross-site request forgery attacks](https://en.wikipedia.org/wiki/Cross-site_request_forgery) that could exist in HTML forms.

```php
Centum\Http\Csrf(
    Centum\Http\Session $session
);
```

`Centum\Http\Csrf` works by generating and storing a random string in a `Centum\Http\Session` object and making this value available for use in a `<form>`.
By comparing the value submitted by the user and the known value from the Session, we can validate whether the POST request is genuine or not.

**By default, `Centum\Http\Form` does not check against CSRF attacks.**

Wherever a POST request requires CSRF protection, the current token value can be obtained from a `Csrf` object and injected into the view:

```php
use Centum\Http\Csrf;
use Centum\Http\Session;

/** @var Session $session */

$csrf = new Csrf($session);

$value = $csrf->get();
```

```html
<form>
    <input type="hidden" name="csrf" value="<?php echo $value; ?>">

    <!-- rest of the form -->
</form>
```

If you're using Twig, you can use the [Centum CSRF Twig extension](../twig/csrf.md) by simply calling the `csrf()` function somewhere in the form:

```twig
<form>
    {% raw %}{{ csrf() }}{% endraw %}

    <!-- rest of the form -->
</form>
```

The CSRF Twig extension also provides the `csrfValue()` function that returns the raw CSRF value which is useful when dealing with AJAX form submissions:

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

Regardless of how the CSRF token is placed, `validateCsrf()` must be called somewhere in your Form's `set()` method in order for Centum to validate it:

```php
use Centum\Container\Container;
use Centum\Http\Form;

class SubmissionForm extends Form
{
    public function set(Container $container): void
    {
        // ...

        $this->validateCsrf();

        // ...
    }
}
```

Values can be regenerated with the `generate()` method.
This method will automatically save the new value to the Session:

```php
$newValue = $csrf->generate();
```

Values can be removed from the Session with the `reset()` method:

```php
$csrf->reset();
```
