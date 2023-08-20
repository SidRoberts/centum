---
layout: default
title: Middlewares
parent: Router
grand_parent: Components
permalink: router/middlewares
nav_order: 4
---



# Middlewares

We already know about Route Groups but we haven't used them yet in a meaningful way.
The main purpose of Route Groups is to be able to assign a Middleware to a collection of Routes easily.
By returning `false` in a Middleware, the Router will ignore that Group and then continue checking the following Groups.

A common use case for Middlewares is to use different Routes for visitors that are logged in and visitors that are not:

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

When creating the Group in the Router, we simply assign the first parameter as a Middleware object:

```php
use App\Auth;
use App\Web\Controllers\AccountController;
use App\Web\Middlewares\IsGuestMiddleware;
use App\Web\Middlewares\IsUserMiddleware;

/** @var Auth $auth */

$guestGroup = $router->group(
    new IsGuestMiddleware($auth)
);

$guestGroup->get("/something", AccountController::class, "guest");



$userGroup = $router->group(
    new IsUserMiddleware($auth)
);

$userGroup->get("/something", AccountController::class, "user");
```

(`App\Web\Middlewares\IsGuestMiddleware` is not shown but performs as you'd expect.)

Now, in a Controller, we can use two different methods, `guest()` and `user()`, for these two groups:

```php
namespace App\Web\Controllers;

use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

class AccountController implements ControllerInterface
{
    public function guest(): ResponseInterface
    {
        return new Response("This visitor is logged out.");
    }

    public function user(): ResponseInterface
    {
        return new Response("This visitor is logged in.");
    }
}
```
