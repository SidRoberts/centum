---
layout: default
title: Middlewares
parent: Router
grand_parent: Components
permalink: router/middlewares
nav_order: 3
---



# Middlewares

We already know about Route Groups but we haven't used them yet in a meaningful way.
The main purpose of Route Groups is to be able to assign a Middleware to a collection of Routes easily.
By returning `false` in a Middleware, the Router will ignore that Group and then continue checking the following Groups.

A common use case for Middlewares is to use different Routes for visitors that are logged in and visitors that are not:

```php
namespace App\Middlewares\Web;

use App\Auth;
use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Interfaces\Router\MiddlewareInterface;

class IsUserMiddleware implements MiddlewareInterface
{
    public function middleware(Request $request, Container $container): bool
    {
        $auth = $container->get(Auth::class);

        return $auth->isLoggedIn();
    }
}
```

(The `App\Auth` class is not shown and is just used as an example.)

When creating the Group in the Router, we simply assign the first parameter as a Middleware object:

```php
use App\Controllers\AccountController;
use App\Middlewares\Web\IsGuestMiddleware;
use App\Middlewares\Web\IsUserMiddleware;

$guestGroup = $router->group(
    new IsGuestMiddleware()
);

$guestGroup->get("/something", AccountController::class, "guest");



$userGroup = $router->group(
    new IsUserMiddleware()
);

$userGroup->get("/something", AccountController::class, "user");
```

(`App\Middlewares\Web\IsGuestMiddleware` is not shown but performs as you'd expect.)

Now, in a Controller, we can use two different methods, `guest()` and `user()`, for these two groups:

```php
namespace App\Controllers;

use Centum\Http\Response;

class AccountController
{
    public function guest(): Response
    {
        return new Response("This visitor is logged out.");
    }

    public function user(): Response
    {
        return new Response("This visitor is logged in.");
    }
}
```
