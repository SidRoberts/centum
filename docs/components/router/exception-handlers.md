---
layout: default
title: Exception Handlers
parent: Router
grand_parent: Components
permalink: router/exception-handlers
---



# Exception Handlers

Exception Handlers are used to catch and handle Exceptions in Controllers.

Exception Handlers can be used to handle 404 errors by handling [`RouteNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Router/Exception/RouteNotFoundException.php):

```php
use App\Controllers\ErrorController;
use Centum\Router\Exception\RouteNotFoundException;

$router->addExceptionHandler(
    RouteNotFoundException::class,
    ErrorController::class,
    "error404"
);
```

Other Exception Handlers could be added to handle specific Exception classes:

```php
use App\Controllers\ErrorController;
use Twig\Error\Error;

$router->addExceptionHandler(
    Error::class,
    ErrorController::class,
    "errorTwig"
);
```

As all Exceptions and Errors extend the `Throwable` class, this example will catch any other Exceptions/Errors.
Take note that exception handlers are processed in the order that they are added so this should be the very last handler:

```php
use App\Controllers\ErrorController;
use Throwable;

$router->addExceptionHandler(
    Throwable::class,
    ErrorController::class,
    "error500"
);
```



## Good Practices

It is **strongly recommended** to have exception handlers for:

- [`Centum\Router\Exception\RouteNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Router/Exception/RouteNotFoundException.php)
- `Throwable`
