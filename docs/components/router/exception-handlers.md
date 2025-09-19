---
layout: default
title: Exception Handlers
parent: Router Component
permalink: router/exception-handlers
nav_order: 7
---



# Exception Handlers

Exception Handlers are used to catch and handle Exceptions in Controllers.
They act as a centralised mechanism to respond to errors in a consistent and controlled manner, rather than allowing the application to crash or display raw error messages.

{: .callout.info }
Exception Handlers must implement [`Centum\Interfaces\Router\ExceptionHandlerInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Router/ExceptionHandlerInterface.php).

Exception Handlers only require the following public method:

- `handle(Centum\Interfaces\Http\RequestInterface $request, Throwable $throwable): Centum\Interfaces\Http\ResponseInterface`

This `handle()` method is called whenever an exception is thrown during the processing of a request.
It receives the original request and the exception that occurred, allowing you to inspect, log, or modify the response as needed.

Multiple Exception Handlers can be added to a Router and can be used to handle different types of Exceptions.
Within the `handle()` method, an [`Centum\Router\Exception\UnsuitableExceptionHandlerException`](https://github.com/SidRoberts/centum/blob/main/src/Router/Exception/UnsuitableExceptionHandlerException.php) can be thrown so that the Router can try another Exception Handler instead.
This enables a flexible chain-of-responsibility pattern, where the Router will attempt multiple handlers in sequence until a suitable one is found.

Exception Handlers can be used to handle 404 errors by handling [`RouteNotFoundException`](https://github.com/SidRoberts/centum/blob/main/src/Router/Exception/RouteNotFoundException.php):

```php
use App\Web\ExceptionHandlers\RouteNotFoundExceptionHandler;

$router->addExceptionHandler(RouteNotFoundExceptionHandler::class);
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

This handler specifically checks for `RouteNotFoundException` and responds with a `404 Not Found` status.
If the exception is of a different type, it throws `UnsuitableExceptionHandlerException`, allowing the Router to pass the exception to the next suitable handler.
This pattern ensures that each Exception Handler only deals with the types of exceptions it is designed to handle.

In the case that other Exception Handlers are unsuitable for a particular Exception, this example will act as a catch-all for any other Exceptions or Errors.
Exception Handlers are processed in the order that they are added to the Application, so this should be the very last Exception Handler:

```php
use App\Web\ExceptionHandlers\ThrowableExceptionHandler;

$router->addExceptionHandler(ThrowableExceptionHandler::class);
```

```php
namespace App\Web\ExceptionHandlers;

use Centum\Http\Response\HtmlResponse;
use Centum\Http\Status;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ExceptionHandlerInterface;
use Throwable;

class ThrowableExceptionHandler implements ExceptionHandlerInterface
{
    public function handle(RequestInterface $request, Throwable $throwable): ResponseInterface
    {
        return new HtmlResponse(
            "<h1>An error occurred</h1>" .
            "<p>" . get_class($throwable) . "</p>" .
            "<p>" . $throwable->getMessage() . "</p>",
            Status::INTERNAL_SERVER_ERROR
        );
    }
}
```

This catch-all handler ensures that any unexpected error will return a structured response rather than crashing the application.
It is particularly useful during development for debugging purposes, but in production, it is recommended to replace the message with a user-friendly error page while logging the full exception details internally.



## Good Practices

It is **strongly recommended** to have exception handlers for:

- [`Centum\Router\Exception\RouteNotFoundException`](https://github.com/SidRoberts/centum/blob/main/src/Router/Exception/RouteNotFoundException.php)
  This ensures that 404 errors are handled gracefully and users receive a clear message when a route does not exist.
- `Throwable`
  Acting as a catch-all ensures that any unhandled exceptions or errors are captured, preventing the application from crashing and exposing sensitive information.

Additionally, you may consider having handlers for:

- Authentication or permission-related exceptions to provide meaningful feedback to users.
- Validation exceptions from forms or API requests to display structured error messages.
- Third-party service exceptions to provide fallback responses when external systems fail.

By defining clear Exception Handlers, you improve the reliability, maintainability, and user experience of your web application.
It also allows you to centralise logging and monitoring for all application errors.



## Logging Exceptions in Production

In a production environment, it is **important to log exceptions** rather than just displaying them to the user.
Logging allows you to track, monitor, and analyse errors over time, which helps with debugging and improving application stability.

You can extend any Exception Handler to log the exception before returning a response. For example:

```php
use Psr\Log\LoggerInterface;
use Centum\Http\Response\HtmlResponse;
use Centum\Http\Status;
use Centum\Interfaces\Http\RequestInterface;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ExceptionHandlerInterface;
use Throwable;

class LoggedThrowableExceptionHandler implements ExceptionHandlerInterface
{
    public function __construct(
        protected LoggerInterface $logger
    ) {
    }

    public function handle(RequestInterface $request, Throwable $throwable): ResponseInterface
    {
        $this->logger->error(
            "Exception caught: " . get_class($throwable) . " - " . $throwable->getMessage(),
            [
                "trace" => $throwable->getTraceAsString(),
                "url"   => $request->getUri(),
            ]
        );

        return new HtmlResponse(
            "<h1>An internal error occurred</h1>",
            Status::INTERNAL_SERVER_ERROR
        );
    }
}
```

Key points about logging exceptions:

- Always log the **exception class**, **message**, and **stack trace**.
- Include context such as the **request URL**, user info (if applicable), or other metadata.
- Display a **friendly message** to the user instead of exposing sensitive details.

By combining Exception Handlers with logging, you can ensure that users receive safe error messages while your team has full visibility into any issues occurring in production.
