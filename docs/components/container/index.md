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
use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;

function my_special_function(Container $container, Request $request, Response $response)
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

You can then retrieve them with the `typehint*()` methods:

```php
use Centum\Console\Application;

$application = $container->typehintClass(Application::class);
```

If the Container is unable to resolve a parameter, it will throw a [`Centum\Container\Exception\UnresolvableParameterException`](https://github.com/SidRoberts/centum/blob/development/src/Container/Exception/UnresolvableParameterException.php).

You can remove objects from the Container using the `remove()` method:

```php
use Centum\Console\Application;

$container->remove(Application::class);
```
