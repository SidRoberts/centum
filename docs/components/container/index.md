---
layout: default
title: Container
parent: Components
has_children: false
permalink: container
---



# `Centum\Container`

The Container component handles object dependencies by centralising object creation.
Whenever an object is created in the Container, it is saved and reused again whenever that class is required.

```php
use Centum\Container\Container;

$container = new Container();
```

{: .highlight }
[`Centum\Container\Container`](https://github.com/SidRoberts/centum/blob/development/src/Container/Container.php) implements [`Centum\Interfaces\Container\ContainerInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Container/ContainerInterface.php).



## Retrieving objects

Classes can be created using the `typehintClass()` method:

```php
use Centum\Router\Router;

$router = $container->typehintClass(Router::class);
```

Methods can be called using the `typehintMethod()` method:

```php
$response = $container->typehintMethod($postController, "index");
```

Functions can be called using the `typehintFunction()` method.

```php
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Interfaces\Container\ContainerInterface;

function my_special_function(ContainerInterface $container, Request $request, Response $response)
{
    /* ... */
}

$result = $container->typehintFunction("my_special_function");
```

The Container will handle all of the parameters.



## Specifying objects

Objects can be set using the `set()` method:

```php
use Centum\Console\Application;
use Centum\Router\Router;

$container->set(Application::class, $application);
$container->set(Router::class, $router);
```

Objects can be dynamically set in a closure using `setDynamic()`.
This closure is typehinted so you can reference other objects in the function signature:

```php
use App\Controllers\ErrorController;
use Centum\Router\Router;
use Throwable;

$container->setDynamic(
    Router::class,
    function (Container $container) {
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

You can then retrieve them with the `typehint*()` methods:

```php
use Centum\Console\Application;

$application = $container->typehintClass(Application::class);
```

If the Container is unable to resolve a parameter, it will throw a [`Centum\Container\Exception\UnresolvableParameterException`](https://github.com/SidRoberts/centum/blob/development/src/Container/Exception/UnresolvableParameterException.php).



## Aliases

Aliases can be added using the `addAlias()` method.
This is particularly useful for interfaces that cannot be directly instantiated:

```php
use Centum\Flash\FormatterInterface;
use Centum\Flash\Formatter\HtmlFormatter;

$container->addAlias(
    FormatterInterface::class,
    HtmlFormatter::class
);
```

Now, any call to `FormatterInterface` will return or create a new `HtmlFormatter` object.

By default, some aliases have already been set:

- `Centum\Interfaces\Container\ContainerInterface`: `Centum\Container\Container`
- `Pheanstalk\Contract\PheanstalkInterface`: `Pheanstalk\Pheanstalk`




## Removing objects

You can remove objects from the Container using the `remove()` method:

```php
use Centum\Console\Application;

$container->remove(Application::class);
```



## Exceptions

(all in the `Centum\Container\Exception` namespace)

- [`UnresolvableParameterException`](https://github.com/SidRoberts/centum/blob/development/src/Container/Exception/UnresolvableParameterException.php)
