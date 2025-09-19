---
layout: default
title: Services
parent: Container Component
permalink: container/services
nav_order: 4
---



# Service

Services exist to define objects that require more than just instantiating it.

For example, a Router would need to have Routes added to it and maybe Exception Handlers too.
A Service can be used to contain this logic that the Container can execute when a Router object is required:

```php
namespace App\Services;

use App\Web\Controllers\IndexController;
use App\Web\ExceptionHandlers\ExceptionHandler;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Container\ServiceInterface;
use Centum\Interfaces\Router\RouterInterface;
use Centum\Router\Router;

/**
 * @implements ServiceInterface<RouterInterface>
 */
class RouterService implements ServiceInterface
{
    public function __construct(
        protected readonly ContainerInterface $container
    ) {
    }

    public function build(): RouterInterface
    {
        $router = new Router($this->container);

        $group = $router->group();

        $group->get("/", IndexController::class, "index");

        $router->addExceptionHandler(ExceptionHandler::class);

        return $router;
    }
}
```

{: .callout.info }
Services must implement [`Centum\Interfaces\Container\ServiceInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Container/ServiceInterface.php).

In the previous case, we needed the Container object to instantiate a new Router object.
Any additional objects that you need can be injected in to the constructor.



## Service Storage

Services are stored in a `ServiceStorageInterface` object which is accessible to the Container.

```php
Centum\Container\ServiceStorage();
```

{: .callout.info }
[`Centum\Container\ServiceStorage`](https://github.com/SidRoberts/centum/blob/main/src/Container/ServiceStorage.php) implements [`Centum\Interfaces\Container\ServiceStorageInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Container/ServiceStorageInterface.php).

You can obtain the Service Storage from a Container:

```php
use Centum\Interfaces\Container\ContainerInterface;

/** @var ContainerInterface $container */

$serviceStorage = $container->getServiceStorage();
```

Adding a Service to the Service Storage is done through the `set()` method:

```php
use App\Services\RouterService;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Router\RouterInterface;

/** @var ContainerInterface $container */

$serviceStorage = $container->getServiceStorage();

$serviceStorage->set(RouterInterface::class, RouterService::class);
```

It is then possible to retreive that object from the Container:

```php
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Router\RouterInterface;

/** @var ContainerInterface $container */

$router = $container->get(RouterInterface::class);
```

The Services's `build()` method is only executed when the object is called for.
