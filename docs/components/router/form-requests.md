---
layout: default
title: Form Requests
parent: Router Component
permalink: router/form-requests
nav_order: 6
---



# Form Requests

Within web apps, a user may submit data either through a HTML form or an API request.
As with all user data, it may be necessary to filter and/or validate that data first before being able to use it.
This ensures the application only works with clean and expected input, which helps prevent errors and potential security vulnerabilities.
Form classes act as a middle layer between raw request data and the business logic in your application.

As a basic example, you may have a login form with a username and password.
Both of these fields are required and must follow certain rules.
By encapsulating these rules in a Form, you can keep your controllers simple and avoid scattering validation logic throughout your code.
First, we need to create a Form:

```php
namespace App\Web\Forms;

use Centum\Interfaces\Http\FormInterface;
use Exception;

class LoginForm implements FormInterface
{
    public function __construct(
        protected string $username,
        protected readonly string $password
    ) {
        $username = mb_trim($username);

        if (mb_strlen($username) < 6) {
            throw new Exception("Username too short.");
        }

        if (mb_strlen($username) > 20) {
            throw new Exception("Username too long.");
        }

        if (preg_match("/[^A-Za-z0-9\-]/", $username)) {
            throw new Exception("Username must be alphanumeric with dashes.");
        }

        $this->username = mb_strtolower($username);



        if (mb_strlen($password) < 6) {
            throw new Exception("Password too short.");
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

This `LoginForm` class enforces several rules about the format and length of the data.
If any of the rules are broken, an `Exception` will be thrown immediately, and no further processing will take place.
This makes it easier to trust the data once the form has been successfully created.

Now we can create a Route:

```php
use App\Web\Controllers\LoginController;

$group->post("/login", LoginController::class, "submit");
```

Within a Controller, you can use a Form to populate it with data from the Request object.
If the data is not valid, a Form can throw an exception to prevent any further code execution.
Exceptions in a Form can be caught with an [exception handler](exception-handlers.md).
This lets you return helpful error messages back to the user without manually writing repetitive validation logic.

As described in the Form, `$username` will be lowercase and trimmed:

```php
namespace App\Web\Controllers;

use App\Web\Forms\LoginForm;
use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

class LoginController implements ControllerInterface
{
    public function submit(LoginForm $loginForm): ResponseInterface
    {
        $username = $loginForm->getUsername();
        $password = $loginForm->getPassword();

        // login($username, $password)

        return new Response(
            sprintf(
                "%s has been logged in",
                $username
            )
        );
    }
}
```

In this controller, the `LoginForm` is automatically constructed and validated before the `submit()` method runs.
By the time this method is called, you can be confident the data meets your defined requirements.
This pattern helps keep controllers concise, readable, and easier to test.
It also makes it much simpler to reuse the same form validation logic in multiple places across your application.
