---
layout: default
title: Middleware
parent: Mvc
---



Middlewares are run by the Router when it is trying to find a matching Route.
If the Route matches the URL pattern, the Router will run the Middlewares which are able to perform additional checks to determine whether the Route should match or not.
By returning `false` in a Middleware, the Router will ignore the Route and assume that it is not suitable for the particular URL.
Alternatively, by throwing [`Centum\Mvc\Exception\RouteNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Mvc/Exception/RouteNotFoundException.php), the Router will also ignore the Route and continue iterating through the other Routes.

Any Middlewares you create must implement [`Centum\Mvc\MiddlewareInterface`](https://github.com/SidRoberts/centum/blob/development/src/MiddlewareInterface.php).

```php
namespace App\Middleware;

use App\Auth;
use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Mvc\MiddlewareInterface;
use Centum\Mvc\Route;

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
use Centum\Mvc\Route;

class GuestRoute extends Route
{
    public function getUri() : string
    {
        return "/something";
    }

    public function getMiddlewares() : array
    {
        return [
            new IsLoggedOutMiddleware(),
        ];
    }

    public function execute(Request $request, Container $container, array $params) : Response
    {
        //TODO
        return new Response("this user is logged out");
    }
}

class UserRoute extends Route
{
    public function getUri() : string
    {
        return "/something";
    }

    public function getMiddlewares() : array
    {
        return [
            new IsLoggedInMiddleware(),
        ];
    }

    public function execute(Request $request, Container $container, array $params) : Response
    {
        //TODO
        return new Response("this user is logged in");
    }
}
```

(`App\Middleware\IsLoggedOutMiddleware` is not shown but performs as you'd expect.)

You can even create Routes with multiple middlewares.
If any of them of fail, the Route will fail to match:

```php
use App\Middleware\OneMiddleware;
use App\Middleware\AnotherMiddleware;
use App\Middleware\AndAnotherMiddleware;
use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Route;

class SomethingRoute extends Route
{
    public function getUri() : string
    {
        return "/something";
    }

    public function getMiddlewares() : array
    {
        return [
            new OneMiddleware(),
            new AnotherMiddleware(),
            new AndAnotherMiddleware(),
        ];
    }

    public function execute(Request $request, Container $container, array $params) : Response
    {
        return new Response("hello");
    }
}
```

The example above will only execute if all 3 middlewares return `true`.
