---
layout: default
title: Adding Routes
parent: Web
grand_parent: Apps
nav_order: 1
---



# Adding Routes

## HTTP Methods

You can specify which HTTP method a route matches.
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

A shorthand exists for this kind of use case which uses the naming convention of `form()` and `submit()`:

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
