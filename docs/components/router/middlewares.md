---
layout: default
title: Middlewares
parent: Router
grand_parent: Components
permalink: router/middlewares
nav_order: 5
---



# Middlewares

We already know about Route Groups but we haven't used them yet in a meaningful way.
The main purpose of Route Groups is to be able to easily assign a Middleware to a collection of Routes.

{: .note }
Middlewares must implement [`Centum\Interfaces\Router\MiddlewareInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Router/MiddlewareInterface.php).

Middlewares only require one public method:

- `check(Centum\Interfaces\Http\RequestInterface $request): bool`

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
We can also use [`Centum\Router\Middleware\InverseMiddleware`](https://github.com/SidRoberts/centum/blob/development/src/Router/Middleware/InverseMiddleware.php) to inverse the result of an existing Middleware so that one Middleware can be used for opposing Groups:

```php
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

Now, in a Controller, we can use two different methods, `user()` and `guest()`, for these two groups:

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



## Callback Middleware

[`Centum\Router\Middleware\CallbackMiddleware`](https://github.com/SidRoberts/centum/blob/development/src/Router/Middleware/CallbackMiddleware.php) can be used to create a custom Middleware without creating a class for it:

```php
use Centum\Interfaces\Http\RequestInterface;
use Centum\Router\Middleware\CallbackMiddleware;

$router->group(
    new CallbackMiddleware(
        function (RequestInterface $request): bool {
            return $request->getMethod() === "POST";
        }
    )
);
```
