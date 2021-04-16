---
layout: default
title: Exception Handlers
parent: Web
grand_parent: Apps
---



# Exception Handlers

Exception Handlers are used to catch and handle Exceptions in Controllers.

Exception Handlers can be used to handle 404 errors by handling [`RouteNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Mvc/Exception/RouteNotFoundException.php):

```php
use App\Controllers\ErrorController;
use Centum\Mvc\Exception\RouteNotFoundException;

$router->addExceptionHandler(
    RouteNotFoundException::class,
    ErrorController::class,
    "error404"
);
```

[Form Request](form-requests.md) exceptions can also be caught:

```php
use App\Controllers\ErrorController;
use Centum\Mvc\Exception\FormRequestException;

$router->addExceptionHandler(
    FormRequestException::class,
    ErrorController::class,
    "errorFormRequest"
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

- [`Centum\Mvc\Exception\RouteNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Mvc/Exception/RouteNotFoundException.php)
- `Throwable`
