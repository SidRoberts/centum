---
layout: default
title: Dynamic URLs
parent: Router
grand_parent: Components
permalink: router/dynamic-urls
nav_order: 3
---



# Dynamic URLs

URLs can be defined with dynamic values by enclosing their identifier in curly brackets (eg. `{id}`):

```php
use App\Controllers\PostController;

$group = $router->group();

$group->get("/post/{id}", PostController::class, "view");
```

This value is then available from the [`Centum\Interfaces\Router\ParametersInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Router/ParametersInterface.php) property within the Controller:

```php
namespace App\Controllers;

use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ParametersInterface;

class PostController
{
    public function view(ParametersInterface $parameters): ResponseInterface
    {
        $id = $parameters->get("id");

        //TODO Do something with $id.

        return new Response("hello $id");
    }
}
```

Multiple parameters can also be defined:

```php
use App\Controllers\CalendarController;

$group = $router->group();

$group->get("/calendar/{year}/{month}/{day}", CalendarController::class, "day");
```

```php
namespace App\Controllers;

use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ParametersInterface;

class CalendarController
{
    public function day(ParametersInterface $parameters): ResponseInterface
    {
        $year  = $parameters->get("year");
        $month = $parameters->get("month");
        $day   = $parameters->get("day");

        //TODO Do something with $year, $month, and $day.

        return new Response("hello $year, $month, $day");
    }
}
```



### Parameter Requirements

You can require that the parameters adhere to a certain format by appending the type onto the end of the parameter identifier.
Currently, 4 types exist:

| Type   | Regular expression          |
| ------ | --------------------------- |
| `int`  | `[\d]+`                     |
| `slug` | `[a-z0-9]+(?:\-[a-z0-9]+)*` |
| `char` | `[^/]`                      |
| `any`  | `[^/]+`                     |

If no type is specified, the Router will default to `any`.

Reusing the `PostController` from earlier, this example will match `/post/1`, `/post/2`, `/post/3` and so on but will not match something like `/post/abc`:

```php
use App\Controllers\PostController;

$group = $router->group();

$group->get("/post/{id:int}", PostController::class, "view");
```
