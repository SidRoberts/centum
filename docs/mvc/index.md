---
layout: default
title: Mvc
has_children: true
permalink: mvc
---



# `Centum\Mvc`

This interpretation of MVC differs slightly from others.

Instead of controllers with multiple action methods and different URLs, this one uses [Route](https://github.com/SidRoberts/centum/blob/development/src/Mvc/Route.php) objects to represent specific URLs.
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

As a Route object points to a specific URL and has defined methods, the job of the [Router](https://github.com/SidRoberts/centum/blob/development/src/Mvc/Router.php) is made simpler.
The Router's job is to convert a [Request](https://github.com/SidRoberts/centum/blob/development/src/Http/Request.php) object into a [Response](https://github.com/SidRoberts/centum/blob/development/src/Http/Response.php) object.
It does so by extracting the Request's URI, it iterates through the Routes until it finds one that matches, and then executes the Route's code which returns a Response.
