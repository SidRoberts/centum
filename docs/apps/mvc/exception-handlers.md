---
layout: default
title: Exception Handlers
parent: Mvc
grand_parent: Apps
---



# Exception Handlers

Exception Handlers are used to catch and handle Exceptions in Controllers.

Exception Handlers can be used to handle 404 errors by handling [`RouteNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Mvc/Exception/RouteNotFoundException.php):

```php
$router->addExceptionHandler(
    \Centum\Mvc\Exception\RouteNotFoundException::class,
    \App\Controllers\ErrorController::class,
    "error404"
);
```

Other Exception Handlers could be added to handle specific Exception classes:

```php
$router->addExceptionHandler(
    \Twig\Error\Error::class,
    \App\Controllers\ErrorController::class,
    "errorTwig"
);
```

As all Exceptions and Errors extend the `Throwable` class, this example will catch any other Exceptions/Errors.
Take note that exception handlers are processed in the order that they are added so this should be the very last handler:

```php
$router->addExceptionHandler(
    \Throwable::class,
    \App\Controllers\ErrorController::class,
    "error500"
);
```
