---
layout: default
title: Routes
parent: Web
grand_parent: Apps
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



## HTTP Methods

When adding a route to the Router, you must specify which HTTP method it matches.
[RFC 7231](https://tools.ietf.org/html/rfc7231#section-4) and [RFC 5789](https://tools.ietf.org/html/rfc5789#section-2) specify the following HTTP methods which correlate with a Router method:

| HTTP Method | Router Method                                    |
| ----------- | ------------------------------------------------ |
| `GET`       | `$router->get($uri, $class, $method, $form)`     |
| `POST`      | `$router->post($uri, $class, $method, $form)`    |
| `HEAD`      | `$router->head($uri, $class, $method, $form)`    |
| `PUT`       | `$router->put($uri, $class, $method, $form)`     |
| `DELETE`    | `$router->delete($uri, $class, $method, $form)`  |
| `TRACE`     | `$router->trace($uri, $class, $method, $form)`   |
| `OPTIONS`   | `$router->options($uri, $class, $method, $form)` |
| `CONNECT`   | `$router->connect($uri, $class, $method, $form)` |
| `PATCH`     | `$router->patch($uri, $class, $method, $form)`   |

The `$form` variable is optional and will be explained later in [Form Requests](form-requests.md). As such, it will be ignored on this page.

If we wanted to add the login form from the `LoginController` in the earlier example, we might decide that it should be a `GET` request and match the `/login` URL:

```php
use App\Controllers\LoginController;

$router->get("/login", LoginController::class, "form");
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

When adding these routes to the Router, you can use the different Router methods to denote which HTTP method they will apply to:

```php
use App\Controllers\LoginController;

$router->get("/login", LoginController::class, "form");
$router->post("/login", LoginController::class, "submit");
```

`GET /login` would match `form()` and `POST /login` would match `submit()`.

A shorthand exists for this kind of use case which uses the naming convention of `form()` and `submit()` inside the Controller:

```php
use App\Controllers\LoginController;

$router->submission("/login", LoginController::class);
```



## Precedence

The Router processes Routes in the order they are added.
In this example, `GET /` would match `AController`:

```php
$router->get("/", AController::class, "index");
$router->get("/", BController::class, "index");
```



## Dynamic URLs

URLs can be defined with dynamic values by enclosing their identifier in curly brackets (eg. `{id}`):

```php
use App\Controllers\PostController;

$router->get("/post/{id}", PostController::class, "view");
```

This value is then available from the `$parameters` property within the Controller:

```php
namespace App\Controllers;

use Centum\Http\Response;
use Centum\Mvc\Parameters;

class PostController
{
    public function view(Parameters $parameters): Response
    {
        $id = $parameters->get("id");

        //TODO Do something with $id.

        return new Response("hello $id");
    }
}
```

Multiple parameters can also be defined:

```php
use App\Controllers\CalendarController;

$router->get("/calendar/{year}/{month}/{day}", CalendarController::class, "day");
```

```php
namespace App\Controllers;

use Centum\Http\Response;
use Centum\Mvc\Parameters;

class CalendarController
{
    public function day(Parameters $parameters): Response
    {
        $year  = $parameters->get("year");
        $month = $parameters->get("month");
        $day   = $parameters->get("day");

        //TODO Do something with $year, $month, and $day.

        return new Response("hello $year, $month, $day");
    }
}
```



### Parameter Requirements

You can require that the parameters adhere to a certain format by appending the type onto the end of the parameter identifier.
Currently, 4 types exist.
If no type is specified, the Router will default to `any`.

| Type   | Regular expression |
| ------ | ------------------ |
| `int`  | `[\d]+`            |
| `slug` | `[a-z0-9\-]+`      |
| `char` | `[^/]`             |
| `any`  | `[^/]+`            |

Reusing the `PostController` from earlier, this example will match `/post/1`, `/post/2`, `/post/3` and so on but will not match something like `/post/abc`:

```php
use App\Controllers\PostController;

$router->get("/post/{id:int}", PostController::class, "view");
```
