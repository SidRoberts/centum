---
layout: default
title: Routes
parent: Mvc
nav_order: 1
---



# Routes

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
