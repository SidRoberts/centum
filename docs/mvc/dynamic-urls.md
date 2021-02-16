---
layout: default
title: Dynamic URLs
parent: Mvc
nav_order: 3
---



# Dynamic URLs

URLs can be defined with dynamic values by enclosing their identifier in curly brackets (eg. `{id}`).
This value is then available from the `$parameters` property:

```php
use Centum\Http\Response;
use Centum\Mvc\Parameters;

class PostController
{
    public function view(Parameters $parameters) : Response
    {
        $id = $parameters->get("id");

        //TODO Do something with $id.

        return new Response("hello $id");
    }
}
```

```php
$router->get("/post/{id}", PostController::class, "view");
```

Multiple parameters can also be defined:

```php
use Centum\Http\Response;
use Centum\Mvc\Parameters;

class SomethingController
{
    public function index(Parameters $parameters) : Response
    {
        $a = $parameters->get("a");
        $b = $parameters->get("b");
        $c = $parameters->get("c");

        //TODO Do something with $a, $b and $c.

        return new Response("hello $a, $b, $c");
    }
}
```

```php
$router->get("/something-crazy/{a}/{b}/{c}", SomethingController::class, "index");
```



## Parameter Requirements

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
use Centum\Http\Response;
use Centum\Mvc\Parameters;

class PostController
{
    public function view(Parameters $parameters) : Response
    {
        $id = $parameters->get("id");

        //TODO Do something with $id.

        return new Response("hello $id");
    }
}
```

```php
$router->get("/post/{id:int}", PostController::class, "view");
```
