---
layout: default
title: HTTP Methods
parent: Mvc
nav_order: 1
---



# HTTP Methods

You can also specify which HTTP method a route matches.
[RFC 7231](https://tools.ietf.org/html/rfc7231#section-4) and [RFC 5789](https://tools.ietf.org/html/rfc5789#section-2) specify the following HTTP methods:

* `GET`
* `POST`
* `HEAD`
* `PUT`
* `DELETE`
* `TRACE`
* `OPTIONS`
* `CONNECT`
* `PATCH`

The Router provides a PHP method for each one and they function identically:

* `$router->get($uri, $class, $method);`
* `$router->post($uri, $class, $method);`
* `$router->head($uri, $class, $method);`
* `$router->put($uri, $class, $method);`
* `$router->delete($uri, $class, $method);`
* `$router->trace($uri, $class, $method);`
* `$router->options($uri, $class, $method);`
* `$router->connect($uri, $class, $method);`
* `$router->patch($uri, $class, $method);`

In this example, the login form and the login submission share the same URL but utilise different HTTP methods:

```php
use Centum\Http\Response;

class LoginController
{
    public function form() : Response
    {
        return new Response("hello GET");
    }

    public function submit() : Response
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
