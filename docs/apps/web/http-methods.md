---
layout: default
title: HTTP Methods
parent: Web
grand_parent: Apps
nav_order: 1
---



# HTTP Methods

You can also specify which HTTP method a route matches.
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

In this example, the login form and the login submission share the same URL but utilise different HTTP methods:

```php
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

```php
$router->get("/login", LoginController::class, "form");
$router->post("/login", LoginController::class, "submit");
```

`GET /login` would match `form()` and `POST /login` would match `submit()`.
