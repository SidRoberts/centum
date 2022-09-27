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
First, we need to create a Form by implementing the `set(ContainerInterface $container)` method and accessing the data from `$this->data` array:

```php
namespace App\Forms;

use Centum\Http\Form;
use Centum\Interfaces\Container\ContainerInterface;
use Exception;

class LoginForm extends Form
{
    protected function set(ContainerInterface $container): void
    {
        $this->setUsername($container);
        $this->setPassword($container);
    }

    protected function setUsername(ContainerInterface $container): void
    {
        $username = $this->data->get("username");

        if (!$username) {
            throw new Exception("Username is required.");
        }

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

        $username = strtolower($username);

        $this->username = $username;
    }

    protected function setPassword(ContainerInterface $container): void
    {
        $password = $this->data->get("password");

        if (!$password) {
            throw new Exception("Password is required.");
        }

        if (strlen($password) < 6) {
            throw new Exception("Password too short.");
        }

        $this->password = $password;
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

All of the setting logic can be kept within the `set()` method but can also be split up into multiple methods, as shown above.

The following properties exist on a Form:

- `$this->request` (`Centum\Interfaces\Http\RequestInterface`)
- `$this->data` (`Centum\Interfaces\Http\DataInterface`)
- `$this->files` (`Centum\Interfaces\Http\FilesInterface`)
- `$this->csrf` (`Centum\Interfaces\Http\CsrfInterface`)

Now we can create a Route:

```php
use App\Controllers\LoginController;

$group = $router->group();

$group->post("/login", LoginController::class, "submit");
```

By using your Form object within the controller, the Container will populate it with data from the Request object.
If the data is not valid, a Form can throw an exception.
Please note that exceptions thrown in a Form can only be caught in an [exception handler](exception-handlers.md).
It is expected that any client-side validation be as thorough as poossible.
Alternatively, you can implement an `isValid()` method that you can access from within the Controller.

In this case, the `submit()` method will only execute if no exceptions are thrown in `LoginForm`.
As described by in the Form, `$username` will be lowercase and trimmed:

```php
namespace App\Controllers;

use App\Models\User;
use Centum\Http\FormRequest;
use Centum\Http\Response;

class LoginController
{
    public function submit(LoginForm $loginForm): Response
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
