---
layout: default
title: Routes
parent: Mvc
---



A Route is responsible for providing the URL pattern (`getUri()`), the HTTP method (`getMethod()`), any middlewares (`getMiddlewares()`), parameter converters (`getConverters()`), and the actual code to run (`execute()`).

By default, a Route has no middlewares or parameter converters and can be as simple as this:

```php
use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Route;

class IndexRoute extends Route
{
    public function getUri() : string
    {
        return "/this/is/your/url";
    }

    public function execute(Request $request, Container $container, array $params) : Response
    {
        return new Response("hello");
    }
}
```

# URL Parameters

URLs can be defined with dynamic values by enclosing their identifier in curly brackets (eg. `{id}`).
This value is then available from the `$params` property:

```php
use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Route;

class ViewSingleRoute extends Route
{
    public function getUri() : string
    {
        return "/post/{id}";
    }

    public function execute(Request $request, Container $container, array $params) : Response
    {
        $id = $params["id"];

        //TODO Do something with $id.

        return new Response("hello $id");
    }
}
```

Multiple parameters can also be defined:

```php
class SomethingRoute extends Route
{
    public function getUri() : string
    {
        return "/something-crazy/{a}/{b}/{c}";
    }

    public function execute(Request $request, Container $container, array $params) : Response
    {
        $a = $params["a"];
        $b = $params["b"];
        $c = $params["c"];

        //TODO Do something with $a, $b and $c.

        return new Response("hello $a, $b, $c");
    }
}
```

# Parameter Requirements

You can also require that the parameters adhere to a certain format by appending the type onto the end of the parameter identifier. Currently, 4 types exist. If no type is specified, the Router will default to `any`.

| Type   | Regular expression |
| ------ | ------------------ |
| `int`  | `[\d]+`            |
| `slug` | `[a-z0-9\-]+`      |
| `char` | `[^/]`             |
| `any`  | `[^/]+`            |

This example will match `/post/1`, `/post/2`, `/post/3` and so on but will not match something like `/post/abc`:

```php
use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Route;

class ViewSingleRoute extends Route
{
    public function getUri() : string
    {
        return "/post/{id:int}";
    }

    public function execute(Request $request, Container $container, array $params) : Response
    {
        $id = $params["id"];

        //TODO Do something with $id.

        return new Response("hello $id");
    }
}
```

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
