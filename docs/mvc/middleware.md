---
layout: default
title: Middleware
parent: Mvc
---



Middlewares are run by the Router when it is trying to find a matching Route.
If the Route matches the URL pattern, the Router will run the Middlewares which are able to perform additional checks to determine whether the Route should match or not.
By returning `false` in a Middleware, the Router will ignore the action and assume that it is not suitable for the particular URL.

Any Middlewares you create must implement [`\Centum\Mvc\MiddlewareInterface`](https://github.com/SidRoberts/centum/blob/development/src/MiddlewareInterface.php) and, like with Converters, you can inject any services you require via the constructor.

```php
namespace Middleware;

use Centum\Mvc\MiddlewareInterface;
use Centum\Mvc\Router\Route;

class IsLoggedInMiddleware implements MiddlewareInterface
{
    protected Auth $auth;



    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }



    public function middleware(string $uri, Route $route) : bool
    {
        return $this->auth->isLoggedIn();
    }
}
```

(The `Auth` class is not shown and is just used as an example)

This is useful for when you want to separate the controller logic into two or more distinct use cases.
For example, you may want to separate guests and logged in users:

```php
use Centum\Mvc\Controller;
use Centum\Mvc\Router\Route\Uri;
use Centum\Mvc\Router\Route\Middleware;
use Middleware\IsLoggedOutMiddleware;
use Middleware\IsLoggedInMiddleware;

class UserController extends Controller
{
    #[Uri("/something")]
    #[Middleware(IsLoggedOutMiddleware::class)]
    public function guest()
    {
        //TODO
    }

    #[Uri("/something")]
    #[Middleware(IsLoggedInMiddleware::class)]
    public function user()
    {
        //TODO
    }
}
```

(`Middleware\IsLoggedOutMiddleware` is not shown but performs as you'd expect)

You can even create action methods with multiple middlewares.
If any of them of fail, the action will fail to match:

```php
use Centum\Mvc\Router\Route\Uri;
use Centum\Mvc\Router\Route\Middleware;
use Middleware\OneMiddleware;
use Middleware\AnotherMiddleware;
use Middleware\AndAnotherMiddleware;

#[Uri("/something")]
#[Middleware(OneMiddleware::class)]
#[Middleware(AnotherMiddleware::class)]
#[Middleware(AndAnotherMiddleware::class)]
public function something()
{
    //TODO
}
```
