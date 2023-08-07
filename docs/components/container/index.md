---
layout: default
title: Container
parent: Components
has_children: true
permalink: container
---



# `Centum\Container`

The Container component handles object dependencies by centralising object creation and storage.
Whenever an object is created in the Container, it is saved and reused again whenever that class is required.

```php
use Centum\Container\Container;

$container = new Container();
```

{: .highlight }
[`Centum\Container\Container`](https://github.com/SidRoberts/centum/blob/development/src/Container/Container.php) implements [`Centum\Interfaces\Container\ContainerInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Container/ContainerInterface.php).



## Retrieving objects

Classes can be retreived using the `get()` method:

```php
use Centum\Interfaces\Router\RouterInterface;

$router = $container->get(RouterInterface::class);
```

If the object does not exist within the Container, then a new instance will be created and returned.



## Specifying objects

Objects can be set using the `set()` method:

```php
use Centum\Interfaces\Router\RouterInterface;

$container->set(RouterInterface::class, $router);
```

Objects can be dynamically set in a closure using `setDynamic()`.
This closure is typehinted so you can reference other objects in the function signature:

```php
use App\Controllers\ErrorController;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Router\RouterInterface;
use Centum\Router\Router;
use Throwable;

$container->setDynamic(
    RouterInterface::class,
    function (ContainerInterface $container) {
        $router = new Router($container);

        $router->addExceptionHandler(
            Throwable::class,
            ErrorController::class,
            "throwable"
        );

        return $router;
    }
);
```

It is then possible to retreive that object from the Container:

```php
use Centum\Interfaces\Router\RouterInterface;

$router = $container->get(RouterInterface::class);
```

If the Container is unable to resolve a parameter, it will throw a [`Centum\Container\Exception\UnresolvableParameterException`](https://github.com/SidRoberts/centum/blob/development/src/Container/Exception/UnresolvableParameterException.php).



## Removing objects

You can remove objects from the Container using the `remove()` method:

```php
use Centum\Interfaces\Router\RouterInterface;

$container->remove(RouterInterface::class);
```



## Exceptions

(all in the `Centum\Container\Exception` namespace)

- [`InstantiateInterfaceException`](https://github.com/SidRoberts/centum/blob/development/src/Container/Exception/InstantiateInterfaceException.php)
- [`UnresolvableParameterException`](https://github.com/SidRoberts/centum/blob/development/src/Container/Exception/UnresolvableParameterException.php)
