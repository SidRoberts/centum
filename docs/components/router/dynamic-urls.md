---
layout: default
title: Dynamic URLs
parent: Router
grand_parent: Components
permalink: router/dynamic-urls
nav_order: 2
---



# Dynamic URLs

URLs can be defined with dynamic values by enclosing their identifier in curly brackets (eg. `{id}`):

```php
use App\Web\Controllers\PostController;

$group = $router->group();

$group->get("/post/{id}", PostController::class, "view");
```

This value is then available from within the Controller:

```php
namespace App\Web\Controllers;

use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

class PostController implements ControllerInterface
{
    public function view(string $id): ResponseInterface
    {
        return new Response("hello $id");
    }
}
```

Multiple parameters can also be defined:

```php
use App\Web\Controllers\CalendarController;

$group = $router->group();

$group->get("/calendar/{year}/{month}/{day}", CalendarController::class, "day");
```

```php
namespace App\Web\Controllers;

use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

class CalendarController implements ControllerInterface
{
    public function day(string $year, string $month, string $day): ResponseInterface
    {
        return new Response("The date is $year-$month-$day.");
    }
}
```



### Parameter Requirements

You can require that the parameters adhere to a certain format by appending the type onto the end of the parameter identifier.
By default, the Router can interpret these 4 types but can be extended using [Replacements](replacements.md):

| Type   | Regular expression          |
| ------ | --------------------------- |
| `int`  | `\d+`                       |
| `slug` | `[a-z0-9]+(?:\-[a-z0-9]+)*` |
| `char` | `[^/]`                      |
| `any`  | `[^/]+`                     |

If no type is specified, the Router will default to `any`.

Reusing the `PostController` from earlier, this example will match `/post/1`, `/post/2`, `/post/3` and so on but will not match something like `/post/abc`:

```php
use App\Web\Controllers\PostController;

$group = $router->group();

$group->get("/post/{id:int}", PostController::class, "view");
```

Also take note that the `int` Replacement converts the value to an integer so you'll need to specify the `int` type in the Controller:

```php
namespace App\Web\Controllers;

use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

class PostController implements ControllerInterface
{
    public function view(int $id): ResponseInterface
    {
        return new Response("hello $id");
    }
}
```
