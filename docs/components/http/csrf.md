---
layout: default
title: CSRF
parent: Http
grand_parent: Components
permalink: http/csrf
nav_order: 6
---



# CSRF

The [`Centum\Http\Csrf`](https://github.com/SidRoberts/centum/blob/development/src/Http/Csrf.php) namespace exists to prevent [cross-site request forgery attacks](https://en.wikipedia.org/wiki/Cross-site_request_forgery) that could exist in HTML forms.

This component comes in three parts: [`Generator`](https://github.com/SidRoberts/centum/blob/development/src/Http/Csrf/Generator.php), [`Storage`](https://github.com/SidRoberts/centum/blob/development/src/Http/Csrf/Storage.php), and [`Validator`](https://github.com/SidRoberts/centum/blob/development/src/Http/Csrf/Validator.php).

{: .highlight }
[`Centum\Http\Csrf\Generator`](https://github.com/SidRoberts/centum/blob/development/src/Http/Csrf/Generator.php) implements [`Centum\Interfaces\Http\Csrf\GeneratorInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/Csrf/GeneratorInterface.php).

{: .highlight }
[`Centum\Http\Csrf\Storage`](https://github.com/SidRoberts/centum/blob/development/src/Http/Csrf/Storage.php) implements [`Centum\Interfaces\Http\Csrf\StorageInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/Csrf/StorageInterface.php).

{: .highlight }
[`Centum\Http\Csrf\Validator`](https://github.com/SidRoberts/centum/blob/development/src/Http/Csrf/Validator.php) implements [`Centum\Interfaces\Http\Csrf\ValidatorInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/Csrf/ValidatorInterface.php).

```php
Centum\Http\Csrf\Generator(
);
```

```php
Centum\Http\Csrf\Storage(
    Centum\Interfaces\Http\SessionInterface $session,
    Centum\Interfaces\Http\Csrf\GeneratorInterface $generator
);
```

```php
Centum\Http\Csrf\Validator(
    Centum\Interfaces\Http\RequestInterface $request,
    Centum\Interfaces\Http\Csrf\StorageInterface $storage
);
```

The `Centum\Http\Csrf` namespace works by generating and storing a random string in a `Centum\Interfaces\Http\SessionInterface` object and making this value available for use in a `<form>`.
By comparing the value submitted by the user and the known value from the Session, we can validate whether the POST request is genuine or not.

Wherever a POST request requires CSRF protection, the current token value can be obtained from a `Storage` object and injected into the view:

```php
use Centum\Interfaces\Http\Csrf\GeneratorInterface;
use Centum\Interfaces\Http\SessionInterface;

/** @var SessionInterface $session */
/** @var GeneratorInterface $generator */

$csrfStorage = new Storage($session, $generator);

$csrfValue = $csrfStorage->get();
```

```html
<form>
    <input type="hidden" name="csrf" value="<?php echo $csrfValue; ?>">

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

Regardless of how the CSRF token is placed, `ValidatorInterface::validate()` must be called at the top of your Form's constructor method to validate it:

```php
namespace App\Forms;

use Centum\Interfaces\Http\Csrf\ValidatorInterface;
use Centum\Interfaces\Http\FormInterface;

class SubmissionForm implements FormInterface
{
    public function __construct(ValidatorInterface $csrfValidator)
    {
        $csrfValidator->validate();

        // ...
    }
}
```

Values are generated with the `GeneratorInterface::generate()` method:

```php
use Centum\Interfaces\Http\Csrf\GeneratorInterface;

/** @var GeneratorInterface $csrfGenerator */

$newValue = $csrfGenerator->generate();
```

Values can be removed from the Session with the `StorageInterface::reset()` method:

```php
use Centum\Interfaces\Http\Csrf\StorageInterface;

/** @var StorageInterface $csrfStorage */

$csrfStorage->reset();
```
