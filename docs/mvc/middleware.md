---
layout: default
title: Middleware
parent: Mvc
---



# Middlewares

Middlewares are run by the Router when it is trying to find a matching Route.
If the Route matches the URL pattern, the Router will run the Middlewares which are able to perform additional checks to determine whether the Route should match or not.
By returning `false` in a Middleware, the Router will ignore the Route and assume that it is not suitable for the particular URL.
Alternatively, by throwing [`Centum\Mvc\Exception\RouteMismatchException`](https://github.com/SidRoberts/centum/blob/development/src/Mvc/Exception/RouteMismatchException.php), the Router will also ignore the Route and continue iterating through the other Routes.

Any Middlewares you create must implement [`Centum\Mvc\MiddlewareInterface`](https://github.com/SidRoberts/centum/blob/development/src/Mvc/MiddlewareInterface.php).

```php
namespace App\Middleware;

use App\Auth;
use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Mvc\MiddlewareInterface;

class IsLoggedInMiddleware implements MiddlewareInterface
{
    public function middleware(Request $request, Route $route, Container $container) : bool
    {
        /**
         * @var Auth
         */
        $auth = $container->get("auth");

        return $auth->isLoggedIn();
    }
}
```

(The `App\Auth` class is not shown and is just used as an example.)

This is useful for when you want to separate the Routes into two or more distinct use cases.
For example, you may want to separate guests and logged in users:

```php
use App\Middleware\IsLoggedOutMiddleware;
use App\Middleware\IsLoggedInMiddleware;
use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;

class AccountController
{
    public function guest() : Response
    {
        //TODO
        return new Response("this user is logged out");
    }

    public function user() : Response
    {
        //TODO
        return new Response("this user is logged in");
    }
}
```

```php
$router->get("/something", AccountController::class, "guest")
    ->addMiddleware(new IsLoggedOutMiddleware());

$router->get("/something", AccountController::class, "user")
    ->addMiddleware(new IsLoggedInMiddleware());
```

(`App\Middleware\IsLoggedOutMiddleware` is not shown but performs as you'd expect.)

You can even create Routes with multiple middlewares.
If any of them of fail, the Route will fail to match:

```php
use Centum\Http\Response;

class SomethingController
{
    public function get() : Response
    {
        return new Response("hello");
    }
}
```

```php
use App\Middleware\OneMiddleware;
use App\Middleware\AnotherMiddleware;
use App\Middleware\AndAnotherMiddleware;

$router->get("/something", SomethingController::class, "get")
    ->addMiddleware(new OneMiddleware())
    ->addMiddleware(new AnotherMiddleware())
    ->addMiddleware(new AndAnotherMiddleware());
```

The example above will only execute if all 3 middlewares return `true`.
