---
layout: default
title: HTTP Methods
parent: Mvc
nav_order: 2
---



# HTTP Methods

You can also specify which HTTP method to match using the `getMethod()` method.

```php
use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Route;

class UrlGetRoute extends Route
{
    public function getUri() : string
    {
        return "/url";
    }

    public function getMethod() : string
    {
        return "GET";
    }

    public function execute(Request $request, Container $container, array $params = []) : Response
    {
        return new Response("hello get");
    }
}

class UrlPostRoute extends Route
{
    public function getUri() : string
    {
        return "/url";
    }

    public function getMethod() : string
    {
        return "POST";
    }

    public function execute(Request $request, Container $container, array $params = []) : Response
    {
        return new Response("hello post");
    }
}
```

`GET /url` would match `UrlGetRoute` and `POST /url` would match `UrlPostRoute`.

Any value is allowed but [RFC 7231](https://tools.ietf.org/html/rfc7231#section-4) and [RFC 5789](https://tools.ietf.org/html/rfc5789#section-2) specify the following values:

* `GET`
* `POST`
* `HEAD`
* `PUT`
* `DELETE`
* `TRACE`
* `OPTIONS`
* `CONNECT`
* `PATCH`

By default, routes will only match `GET`.
