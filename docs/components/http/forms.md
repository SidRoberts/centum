---
layout: default
title: Forms
parent: Http
grand_parent: Components
permalink: http/forms
---



# Forms

Whilst it is possible to access a [`RequestInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/RequestInterface.php) from with a Controller, it is sometimes necessary to format or validate this data before using it.

Forms that implement [`Centum\Interfaces\Http\FormInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/FormInterface.php) have special access to the data and files in a Request:

```php
namespace App\Forms;

use Centum\Interfaces\Http\FormInterface;
use InvalidArgumentException;

class LoginForm implements FormInterface
{
    public function __construct(
        protected readonly string $username,
        protected readonly string $password
    ) {
        if (strlen($username) < 6) {
            throw new InvalidArgumentException("Username is too short.");
        }

        if (strlen($password) < 6) {
            throw new InvalidArgumentException("Password is too short.");
        }
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
```

You can then inject the Form in a Controller:

```php
namespace App\Controllers;

use App\Forms\LoginForm;
use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

class LoginController implements ControllerInterface
{
    public function form(): ResponseInterface
    {
        return new Response("<form><!-- Login form --></form>");
    }

    public function submit(LoginForm $loginForm): ResponseInterface
    {
        return new Response("Hello {$loginForm->getUsername()}");
    }
}
```



## Different Types of Data

### `bool`

You can use the `bool` type in the constructor to confirm whether a field exists in the Request data.
This can be useful with checkboxes as they only send data if they are selected.

For example, a login form might have a checkbox to remember the user:

```html
<form>
    <input type="text" name="username">
    <input type="password" name="password">

    <div>
        <input type="checkbox" name="rememberMe">
        Remember me
    </div>

    <button type="submit">Submit</button>
</form>
```

```php
namespace App\Forms;

use Centum\Interfaces\Http\FormInterface;

class LoginForm implements FormInterface
{
    public function __construct(
        protected readonly string $username,
        protected readonly string $password,
        protected readonly bool $rememberMe
    ) {
        // ...
    }

    // ...
}
```



### `array`

If a field has multiple values, you can use the `array` type in the constructor:

```html
<form>
    <div>
        Who are your friends?
        <input type="text" name="friends[]">
        <input type="text" name="friends[]">
        <input type="text" name="friends[]">
    </div>

    <button type="submit">Submit</button>
</form>
```

```php
namespace App\Forms;

use Centum\Interfaces\Http\FormInterface;

class FriendsForm implements FormInterface
{
    /**
     * @param array<string> $friends
     */
    public function __construct(
        protected readonly array $friends
    ) {
        // ...
    }

    // ...
}
```



## Optional Fields

In the previous examples, all of the fields were required by the Form.
It is possible to make these optional by allowing `null` or setting a default value in the constructor:

```php
namespace App\Forms;

use Centum\Interfaces\Http\FormInterface;

class ExampleForm implements FormInterface
{
    public function __construct(
        protected readonly string $requiredField,
        protected readonly ?string $optionalField1, // Will be `null` if not set.
        protected readonly string $optionalField2 = "default value"
    ) {
        // ...
    }

    // ...
}
```



## Injecting Things from the Container

You can, of course, inject things from the Container, as you normally would:

```php
namespace App\Forms;

use Centum\Interfaces\Clock\ClockInterface;
use Centum\Interfaces\Http\FormInterface;
use DateTimeImmutable;
use InvalidArgumentException;

class CreateUserForm implements FormInterface
{
    protected readonly DateTimeImmutable $dateCreated;

    public function __construct(
        protected readonly string $username,
        protected readonly string $password,
        ClockInterface $clock,
        UsernameChecker $usernameChecker
    ) {
        if (strlen($username) < 6) {
            throw new InvalidArgumentException("Username is too short.");
        }

        if ($usernameChecker->usernameExists($username)) {
            throw new InvalidArgumentException("Username already exists.");
        }

        if (strlen($password) < 6) {
            throw new InvalidArgumentException("Password is too short.");
        }

        $this->dateCreated = $clock->now();
    }


    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getDateCreated(): DateTimeImmutable
    {
        return $this->dateCreated;
    }
}
```

(`UsernameChecker` not shown but checks if a username already exists in the database).



## File Uploads

File uploads can also be accessed in a Form:

```html
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="images" multiple />

    <button type="submit">Upload</button>
</form>
```

In the Form, you can access the [`FileGroupInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/FileGroupInterface.php) instances:

```php
namespace App\Forms;

use Centum\Interfaces\Http\FileGroupInterface;
use Centum\Interfaces\Http\FormInterface;
use InvalidArgumentException;

class UploadForm implements FormInterface
{
    public function __construct(
        protected readonly FileGroupInterface $images
    ) {
        if (count($images->all()) === 0) {
            throw new InvalidArgumentException(
                "No images uploaded."
            );
        }
    }

    public function getImages(): FileGroupInterface
    {
        return $this->images;
    }
}
```
