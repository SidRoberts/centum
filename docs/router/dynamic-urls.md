---
layout: default
title: Dynamic URLs
parent: Router Component
permalink: router/dynamic-urls
nav_order: 2
---



# Dynamic URLs

Dynamic URLs allow you to define routes that include variable segments within the path.
This is useful when you want to capture values from the URL itself and pass them into your controller actions.
To define a dynamic URL, place the parameter name inside curly brackets (for example, `{username}`) within the route path:

```php
use App\Web\Controllers\UserController;

$group->get("/user/{username}", UserController::class, "view");
```

In this example, when a user visits a URL such as `/user/sidroberts`, the value `sidroberts` will be captured and passed into the controller as the `$username` argument.
This makes it easy to retrieve resources or perform logic based on the value supplied in the URL.

Inside the controller, you can access the captured parameter just like any other method argument:

```php
namespace App\Web\Controllers;

use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

class UserController implements ControllerInterface
{
    public function view(string $username): ResponseInterface
    {
        return new Response("Hello {$username}.");
    }
}
```

You are not limited to a single parameter — multiple parameters can also be defined within the same route.
This allows you to build URLs that represent structured data, such as dates:

```php
use App\Web\Controllers\CalendarController;

$group->get("/calendar/{year}/{month}/{day}", CalendarController::class, "day");
```

And then access each parameter inside your controller method:

```php
namespace App\Web\Controllers;

use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

class CalendarController implements ControllerInterface
{
    public function day(string $year, string $month, string $day): ResponseInterface
    {
        return new Response("The date is {$year}-{$month}-{$day}.");
    }
}
```

{: .callout.info }
The parameters exist as strings because we're taking them straight from the URL.

This approach keeps your routes flexible and makes it easy to create clean, meaningful URLs that reflect the data they represent.



## Parameter Requirements

In many cases, you might want to ensure that the values passed through your dynamic parameters follow a specific format.
The Router allows you to define parameter **types**, which apply regular expression patterns to the parameter values to validate them.
This ensures that only URLs matching the correct structure will be routed to your controller.

To apply a type, append it to the parameter identifier after a colon.
By default, the Router understands the following types:

| Type     | Regular expression                                             | Description                                                                   |
| -------- | -------------------------------------------------------------- | ----------------------------------------------------------------------------- |
| `any`    | `[^/]+`                                                        | Anything                                                                      |
| `int`    | `\d+`                                                          | Integer                                                                       |
| `slug`   | `[a-z0-9]+(?:\-[a-z0-9]+)*`                                    | Slug (such as `hello-world`)                                                  |
| `char`   | `[^/]`                                                         | A single character                                                            |
| `sha256` | `[0-9a-f]{64}`                                                 | Sha256 sum                                                                    |
| `uuid4`  | `[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}` | [UUID version 4](https://en.wikipedia.org/wiki/Universally_unique_identifier) |

If no type is specified, the Router will default to using `any`, which accepts any non-slash characters.

You can also extend this list with your own custom types by using [Replacements](replacements.md).

For example, this route definition ensures that only valid numeric IDs are passed to the controller, so URLs like `/post/1`, `/post/2`, and `/post/42` will match, but `/post/abc` will not:

```php
use App\Web\Controllers\PostController;

$group->get("/post/{id:int}", PostController::class, "view");
```

Also, note that when you specify a parameter type, the Router is able to cast the value to the correct PHP type if applicable.
The `int` type will convert the parameter into an integer, so your controller method should declare the parameter as an `int`:

```php
namespace App\Web\Controllers;

use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

class PostController implements ControllerInterface
{
    public function view(int $id): ResponseInterface
    {
        return new Response("This is post #{$id}.");
    }
}
```

This type casting makes your code safer and more predictable by ensuring that the values you receive in your controller have already been validated and normalised.
