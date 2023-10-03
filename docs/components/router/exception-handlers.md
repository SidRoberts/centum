---
layout: default
title: Exception Handlers
parent: Router
grand_parent: Components
permalink: router/exception-handlers
nav_order: 7
---



# Exception Handlers

Exception Handlers are used to catch and handle Exceptions in Controllers.

{: .note }
Exception Handlers must implement [`Centum\Interfaces\Router\ExceptionHandlerInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Router/ExceptionHandlerInterface.php).

Exception Handlers only require the following public method:

- `public function handle(Centum\Interfaces\Http\RequestInterface $request, Throwable $throwable): Centum\Interfaces\Http\ResponseInterface`

Multiple Exception Handlers can be added to a Router and can be used to handle different types of Exceptions.
Within the `handle()` method, an [`Centum\Router\Exception\UnsuitableExceptionHandlerException`](https://github.com/SidRoberts/centum/blob/development/src/Router/Exception/UnsuitableExceptionHandlerException.php) can be thrown so that the Router can try another Exception Handler instead.

Exception Handlers can be used to handle 404 errors by handling [`RouteNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Router/Exception/RouteNotFoundException.php):

```php
use App\Web\ExceptionHandlers\RouteNotFoundExceptionHandler;

$router->addExceptionHandler(
    RouteNotFoundExceptionHandler::class
);
```

```php
namespace App\Web\ExceptionHandlers;

use Centum\Http\Response;
use Centum\Http\Status;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ExceptionHandlerInterface;
use Centum\Router\Exception\RouteNotFoundException;
use Centum\Router\Exception\UnsuitableExceptionHandlerException;
use Throwable;

class RouteNotFoundExceptionHandler implements ExceptionHandlerInterface
{
    public function handle(RequestInterface $request, Throwable $throwable): ResponseInterface
    {
        if (!($throwable instanceof RouteNotFoundException)) {
            throw new UnsuitableExceptionHandlerException($this);
        }

        return new Response(
            "Page not found",
            Status::NOT_FOUND
        );
    }
}
```

In the case that other Exception Handlers are unsuitable for a particular Exception, this example will act as a catch-all for any other Exceptions/Errors.
Exception Handlers are processed in the order that they are added to the Application so this should be the very last Exception Handler:

```php
use App\Web\ExceptionHandlers\ThrowableExceptionHandler;

$router->addExceptionHandler(
    ThrowableExceptionHandler::class
);
```

```php
namespace App\Web\ExceptionHandlers;

use Centum\Http\Response;
use Centum\Http\Status;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ExceptionHandlerInterface;
use Throwable;

class ThrowableExceptionHandler implements ExceptionHandlerInterface
{
    public function handle(RequestInterface $request, Throwable $throwable): ResponseInterface
    {
        return new Response(
            "<h1>An error occurred</h1>" .
            "<p>" . get_class($throwable) . "</p>" .
            "<p>" . $throwable->getMessage() . "</p>",
            Status::INTERNAL_SERVER_ERROR
        );
    }
}
```



## Good Practices

It is **strongly recommended** to have exception handlers for:

- [`Centum\Router\Exception\RouteNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Router/Exception/RouteNotFoundException.php)
- `Throwable`
