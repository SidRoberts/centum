---
layout: default
title: Form Requests
parent: Router
grand_parent: Components
permalink: router/form-requests
---



# Form Requests

Within web apps, a user may submit data either through a HTML form or an API request.
As with all user data, it may be necessary to filter and/or validate that data first before being able to use it.

As a basic example, you may have a login form with a username and password.
Both of these fields are required and must follow certain rules.
First, we need to create a Form:

```php
namespace App\Forms;

use Centum\Interfaces\Http\FormInterface;
use Exception;

class LoginForm implements FormInterface
{
    public function __construct(
        protected string $username,
        protected readonly string $password
    ) {
        $username = trim($username);

        if (strlen($username) < 6) {
            throw new Exception("Username too short.");
        }

        if (strlen($username) > 20) {
            throw new Exception("Username too long.");
        }

        if (preg_match("/[^A-Za-z0-9\-]/", $username)) {
            throw new Exception("Username must be alphanumeric with dashes.");
        }

        $this->username = strtolower($username);



        if (strlen($password) < 6) {
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

Now we can create a Route:

```php
use App\Controllers\LoginController;

$group = $router->group();

$group->post("/login", LoginController::class, "submit");
```

Within a Controller, you can use a Form to populate it with data from the Request object.
If the data is not valid, a Form can throw an exception to prevent any further code execution.
Exceptions in a Form can be caught with an [exception handler](exception-handlers.md).

As described in the Form, `$username` will be lowercase and trimmed:

```php
namespace App\Controllers;

use App\Forms\LoginForm;
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
