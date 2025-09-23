---
layout: default
title: Routes
parent: Router Component
permalink: router/routes
nav_order: 1
---



# Routes

## Controllers

Controllers are classes that are responsible for returning [`Centum\Interfaces\Http\ResponseInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/ResponseInterface.php) objects.
When a user visits a URL or submits a form, the Router will direct the request to the appropriate Controller method, which will then generate and return a Response.

{: .callout.info }
Controllers must implement [`Centum\Interfaces\Router\ControllerInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Router/ControllerInterface.php).

A Controller can have as many methods as you'd like and although it is not able to be enforced by `ControllerInterface`, every method should return a `ResponseInterface`.

A Controller can be as simple as the following example, which returns plain text:

```php
namespace App\Web\Controllers;

use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

class LoginController implements ControllerInterface
{
    public function form(): ResponseInterface
    {
        return new Response("this is the login page");
    }
}
```

However, Controllers can do far more: they can use dependency injection to receive services, apply filters and middlewares, and perform tasks such as form validation.
These advanced features will be explained in later sections, but it is important to know that these things are possible.

{: .callout.info }
[`Centum\Http\Response\HtmlResponse`](https://github.com/SidRoberts/centum/blob/main/src/Http/Response/HtmlResponse.php) can be used for HTML responses and [`Centum\Http\Response\JsonResponse`](https://github.com/SidRoberts/centum/blob/main/src/Http/Response/JsonResponse.php) can be used for JSON responses.



## Route Groups

Routes are not added to the Router directly.
Instead, to keep the Router class simple and organised, Routes are stored inside [Group](https://github.com/SidRoberts/centum/blob/main/src/Router/Group.php) objects.
Grouping routes together helps you organise related routes (for example, all the routes for user accounts or all the routes for an admin area).

{: .callout.info }
[`Centum\Router\Group`](https://github.com/SidRoberts/centum/blob/main/src/Router/Group.php) implements [`Centum\Interfaces\Router\GroupInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Router/GroupInterface.php).

You can create a new group using the `group()` method on the Router:

```php
use Centum\Interfaces\Router\RouterInterface;

/** @var RouterInterface $router */

$group = $router->group();
```

Each group can contain as many routes as you want, and using groups allows you to apply middlewares to every route inside that group at once.
We will go deeper into this in the [Middlewares](middlewares.md) section.



## HTTP Methods

When defining a route, you must tell the Router which HTTP method the route should respond to.
This ensures that different kinds of requests (like viewing a page versus submitting data) are correctly separated.
The standard HTTP methods are defined in [RFC 7231](https://tools.ietf.org/html/rfc7231#section-4) and [RFC 5789](https://tools.ietf.org/html/rfc5789#section-2).

Each of these methods has a corresponding method on the Group object:

| HTTP Method | Group Method                             |
| ----------- | ---------------------------------------- |
| `GET`       | `$group->get($uri, $class, $method)`     |
| `POST`      | `$group->post($uri, $class, $method)`    |
| `HEAD`      | `$group->head($uri, $class, $method)`    |
| `PUT`       | `$group->put($uri, $class, $method)`     |
| `DELETE`    | `$group->delete($uri, $class, $method)`  |
| `TRACE`     | `$group->trace($uri, $class, $method)`   |
| `OPTIONS`   | `$group->options($uri, $class, $method)` |
| `CONNECT`   | `$group->connect($uri, $class, $method)` |
| `PATCH`     | `$group->patch($uri, $class, $method)`   |

For example, if we want to display a login form at `/login` using the `form()` method from our `LoginController`, we would add a `GET` route for it like this:

```php
use App\Web\Controllers\LoginController;

$group->get("/login", LoginController::class, "form");
```

### Same URL, Different Methods

It is common to have the same URL respond differently based on the HTTP method.
A typical example is having a login page that displays a form on `GET /login` and processes the submitted form data on `POST /login`.

Here is a controller that handles both cases:

```php
namespace App\Web\Controllers;

use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

class LoginController implements ControllerInterface
{
    public function form(): ResponseInterface
    {
        return new Response("This is a GET request.");
    }

    public function submit(): ResponseInterface
    {
        return new Response("This is a POST request.");
    }
}
```

And here is how you would register both routes with the Router:

```php
use App\Web\Controllers\LoginController;

$group->get("/login", LoginController::class, "form");
$group->post("/login", LoginController::class, "submit");
```

When the user visits `/login` with a GET request, the `form()` method will run.
When the user submits the form with a POST request to `/login`, the `submit()` method will run.

There is also a shorthand method called `submission()` for this common pattern.
It assumes your controller uses the `form()` and `submit()` method names:

```php
use App\Web\Controllers\LoginController;

$group->submission("/login", LoginController::class);
```



## Precedence

Routes are processed in the order they are added.
This means the Router will check the first route you defined, then the second, and so on, stopping at the first route that matches the incoming request.

For example, in this code, the `GET /` request will always match `AController` because it is defined before `BController`:

```php
$group->get("/", AController::class, "index");
$group->get("/", BController::class, "index");
```

Be careful not to accidentally define duplicate routes, as the later ones will never run.



## Trailing Slashes

Centum automatically removes trailing slashes from incoming request URLs.
This means that requests to `/login` and `/login/` will be treated as the same route (`/login`).
Because of this, you should always define your route URIs without a trailing slash (unless the route is simply `/`).
