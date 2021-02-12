---
layout: default
title: HTTP Methods
parent: Mvc
nav_order: 1
---



# HTTP Methods

You can also specify which HTTP method:

```php
use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Route;

class UrlRoute extends Route
{
    public function uri() : string
    {
        return "/url";
    }

    public function get(Request $request, Container $container, array $params = []) : Response
    {
        return new Response("hello GET");
    }

    public function post(Request $request, Container $container, array $params = []) : Response
    {
        return new Response("hello POST");
    }
}
```

`GET /url` would match `get()` and `POST /url` would match `post()`.

[RFC 7231](https://tools.ietf.org/html/rfc7231#section-4) and [RFC 5789](https://tools.ietf.org/html/rfc5789#section-2) specify the following values:

* `GET`
* `POST`
* `HEAD`
* `PUT`
* `DELETE`
* `TRACE`
* `OPTIONS`
* `CONNECT`
* `PATCH`
