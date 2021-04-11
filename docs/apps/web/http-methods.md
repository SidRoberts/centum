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

| HTTP Method | Router Method                             |
| ----------- | ----------------------------------------- |
| `GET`       | `$router->get($uri, $class, $method)`     |
| `POST`      | `$router->post($uri, $class, $method)`    |
| `HEAD`      | `$router->head($uri, $class, $method)`    |
| `PUT`       | `$router->put($uri, $class, $method)`     |
| `DELETE`    | `$router->delete($uri, $class, $method)`  |
| `TRACE`     | `$router->trace($uri, $class, $method)`   |
| `OPTIONS`   | `$router->options($uri, $class, $method)` |
| `CONNECT`   | `$router->connect($uri, $class, $method)` |
| `PATCH`     | `$router->patch($uri, $class, $method)`   |

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
