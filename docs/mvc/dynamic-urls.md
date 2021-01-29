---
layout: default
title: Dynamic URLs
parent: Mvc
nav_order: 2
---



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

You can require that the parameters adhere to a certain format by appending the type onto the end of the parameter identifier.
Currently, 4 types exist.
If no type is specified, the Router will default to `any`.

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
