---
layout: default
title: CSRF
parent: Http
grand_parent: Components
permalink: http/csrf
nav_order: 6
---



# CSRF

Cross-Site Request Forgery (CSRF) is a security vulnerability that allows attackers to perform actions on behalf of authenticated users without their consent.
Centum's CSRF protection helps prevent these attacks by generating, storing, and validating secure tokens for HTML forms.



## How It Works

- A random token is generated and stored in the user's session.
- The token is injected into forms as a hidden field.
- On form submission, the token is validated against the stored value.
- If the token matches, the request is considered genuine.



## Overview

The [`Centum\Http\Csrf`](https://github.com/SidRoberts/centum/blob/main/src/Http/Csrf.php) namespace provides three main classes:

- [`Generator`](https://github.com/SidRoberts/centum/blob/main/src/Http/Csrf/Generator.php): Generates random CSRF tokens.
- [`Storage`](https://github.com/SidRoberts/centum/blob/main/src/Http/Csrf/Storage.php): Stores and retrieves tokens using the session.
- [`Validator`](https://github.com/SidRoberts/centum/blob/main/src/Http/Csrf/Validator.php): Validates tokens on incoming requests.

{: .highlight }
[`Centum\Http\Csrf\Generator`](https://github.com/SidRoberts/centum/blob/main/src/Http/Csrf/Generator.php) implements [`Centum\Interfaces\Http\Csrf\GeneratorInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/Csrf/GeneratorInterface.php).

{: .highlight }
[`Centum\Http\Csrf\Storage`](https://github.com/SidRoberts/centum/blob/main/src/Http/Csrf/Storage.php) implements [`Centum\Interfaces\Http\Csrf\StorageInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/Csrf/StorageInterface.php).

{: .highlight }
[`Centum\Http\Csrf\Validator`](https://github.com/SidRoberts/centum/blob/main/src/Http/Csrf/Validator.php) implements [`Centum\Interfaces\Http\Csrf\ValidatorInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/Csrf/ValidatorInterface.php).

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



## Usage

### 1. Obtaining a CSRF Token

Wherever a POST request requires CSRF protection, the current token value can be obtained from a `Storage` object and injected into the view:

```php
use Centum\Http\Csrf\Storage;
use Centum\Interfaces\Http\Csrf\GeneratorInterface;
use Centum\Interfaces\Http\SessionInterface;

/** @var SessionInterface $session */
/** @var GeneratorInterface $generator */

$csrfStorage = new Storage($session, $generator);

$csrfValue = $csrfStorage->get();
```

### 2. Add the Token to Your Form

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

### 3. Validate the Token

Call `ValidatorInterface::validate()` at the start of your form handler:

```php
namespace App\Web\Forms;

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

### 4. Generate or Reset Tokens

Generate a new token:

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
