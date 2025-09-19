---
layout: default
title: Middlewares
parent: Router Component
permalink: router/middlewares
nav_order: 5
---



# Middlewares

We already know about Route Groups but we haven't used them yet in a meaningful way.
The main purpose of Route Groups is to be able to easily assign a Middleware to a collection of Routes.
This allows you to apply common logic (like authentication, access control, or request filtering) to multiple routes at once without duplicating code.

{: .callout.info }
Middlewares must implement [`Centum\Interfaces\Router\MiddlewareInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Router/MiddlewareInterface.php).

Middlewares only require one public method:

- `check(Centum\Interfaces\Http\RequestInterface $request): bool`

This method should return `true` if the request is allowed to proceed through the group or `false` if it should be rejected.
By returning `false` in a Middleware, the Router will ignore that Group and then continue checking the following Groups.

A common use case for Middlewares is to use different Routes for visitors that are logged in and visitors that are not.
First, we need to create a Middleware to check if the user is logged in:

```php
namespace App\Web\Middlewares;

use App\Auth;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Router\MiddlewareInterface;

class IsUserMiddleware implements MiddlewareInterface
{
    public function __construct(
        protected readonly Auth $auth
    ) {
    }

    public function check(RequestInterface $request): bool
    {
        return $this->auth->isLoggedIn();
    }
}
```

(The `App\Auth` class is not shown and is just used as an example.)

When creating the Group in the Router, we simply assign the first parameter as a `MiddlewareInterface` object.
This will make the Router automatically run the Middleware before matching any of the group's routes.
We can also use [`Centum\Router\Middleware\InverseMiddleware`](https://github.com/SidRoberts/centum/blob/main/src/Router/Middleware/InverseMiddleware.php) to inverse the result of an existing Middleware so that one Middleware can be used for opposing Groups.
This helps keep the code clean because you don’t need to write two separate Middlewares for opposite conditions.

```php
use App\Web\Controllers\AccountController;
use App\Web\Middlewares\IsUserMiddleware;
use Centum\Router\Middleware\InverseMiddleware;

/** @var IsUserMiddleware $isUserMiddleware */



$userGroup = $router->group($isUserMiddleware);

$userGroup->get("/account", AccountController::class, "user");



$guestGroup = $router->group(
    new InverseMiddleware($isUserMiddleware)
);

$guestGroup->get("/account", AccountController::class, "guest");
```

Now, in a Controller, we can use two different methods, `user()` and `guest()`, for these two groups.
Because the Middlewares decide which group the request falls into, the Router will only call the matching Controller method:

```php
namespace App\Web\Controllers;

use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

class AccountController implements ControllerInterface
{
    public function user(): ResponseInterface
    {
        return new Response("This visitor is logged in.");
    }

    public function guest(): ResponseInterface
    {
        return new Response("This visitor is logged out.");
    }
}
```

This pattern is useful because it keeps logic for different types of users separate and easy to maintain.
You can easily extend this approach to include Middlewares for admin-only routes, API keys, or any other access rules you need.



## Callback Middleware

[`Centum\Router\Middleware\CallbackMiddleware`](https://github.com/SidRoberts/centum/blob/main/src/Router/Middleware/CallbackMiddleware.php) can be used to create a custom Middleware without creating a class for it.
This is especially handy for very small or one-off checks that don’t need their own class file:

```php
use Centum\Interfaces\Http\RequestInterface;
use Centum\Router\Middleware\CallbackMiddleware;

$group = $router->group(
    new CallbackMiddleware(
        function (RequestInterface $request): bool {
            return $request->getMethod() === "POST";
        }
    )
);
```

Alternatively, you can create an anonymous class:

```php
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Router\MiddlewareInterface;

$group = $router->group(
    new class implements MiddlewareInterface
    {
        function check(RequestInterface $request): bool
        {
            return $request->getMethod() === "POST";
        }
    }
)
```

These examples create a group that only matches POST requests.
For anything more complex or reusable, creating a dedicated Middleware class is usually the better approach.
