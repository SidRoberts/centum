---
layout: default
title: Routes
parent: Mvc
nav_order: 1
---



# Routes

A Route is responsible for providing the URL pattern (`uri()`), any middlewares (`middlewares()`), parameter converters (`converters()`), and the actual code to run depending on the HTTP method (`get()`, `post()`, ...).

By default, a Route has no middlewares or parameter converters and can be as simple as this:

```php
use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Route;

class IndexRoute extends Route
{
    public function uri() : string
    {
        return "/this/is/your/url";
    }

    public function get(Request $request, Container $container, array $params) : Response
    {
        return new Response("hello");
    }
}
```
