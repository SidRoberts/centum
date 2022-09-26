---
layout: default
title: Routes
parent: Router
grand_parent: Components
permalink: router/routes
nav_order: 1
---



# Routes

## Controllers

Controllers are responsible for returning [Response](https://github.com/SidRoberts/centum/blob/development/src/Http/Response.php) objects.
Controllers don't have to extend or implement anything and can be as simple as this:

```php
namespace App\Controllers;

use Centum\Http\Response;

class LoginController
{
    public function form(): Response
    {
        return new Response("this is the login page");
    }
}
```

Controllers can also take advantage of things like dependency injection, filters, middlewares, and form validation which we'll learn more about later.



## Route Groups

In order to simplify the Route and Router classes, Routes are stored in [Group](https://github.com/SidRoberts/centum/blob/development/src/Router/Group.php) objects.
A group can store as many routes as you wish and can be used to organise and group similar routes.
A new group can be created with the `group()` method:

```php
use Centum\Router\Router;

/** @var Router $router */

$group = $router->group();
```

We'll learn more about Route Groups and how they can be useful in the [Middlewares](middlewares.md) section.



## HTTP Methods

When adding a route to the Router, you must specify which HTTP method it matches.
[RFC 7231](https://tools.ietf.org/html/rfc7231#section-4) and [RFC 5789](https://tools.ietf.org/html/rfc5789#section-2) specify the following HTTP methods which correlate with a Group method:

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

If we wanted to add the login form from the `LoginController` in the earlier example, we might decide that it should be a `GET` request and match the `/login` URL:

```php
use App\Controllers\LoginController;
use Centum\Router\Router;

/** @var Router $router */

$group = $router->group();

$group->get("/login", LoginController::class, "form");
```



### Same URL, Different Methods

It's likely that at some point you'll want to use the same URL for different things.
For example, you might want to show users a login form at `/login` but also allow the form to submit the login data to `/login`:

```php
namespace App\Controllers;

use Centum\Http\Response;

class LoginController
{
    public function form(): Response
    {
        return new Response("hello GET");
    }

    public function submit(): Response
    {
        return new Response("hello POST");
    }
}
```

When adding these routes to the Router, you can use the different Group methods to denote which HTTP method they will apply to:

```php
use App\Controllers\LoginController;

$group = $router->group();

$group->get("/login", LoginController::class, "form");
$group->post("/login", LoginController::class, "submit");
```

`GET /login` would match `form()` and `POST /login` would match `submit()`.

A shorthand exists for this kind of use case which uses the naming convention of `form()` and `submit()` inside the Controller:

```php
use App\Controllers\LoginController;

$group = $router->group();

$group->submission("/login", LoginController::class);
```



## Precedence

The Router processes Routes in the order they are added.
In this example, `GET /` would match `AController`:

```php
$group = $router->group();

$group->get("/", AController::class, "index");
$group->get("/", BController::class, "index");
```
