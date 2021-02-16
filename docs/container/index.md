---
layout: default
title: Container
has_children: true
permalink: container
---



# `Centum\Container`

The Container component handles object dependencies by centralising object creation.
Whenever an object is created in the Container, it is saved and reused again whenever that class is required.

Classes can be created using the `typehintClass()` method:

```php
use Centum\Container\Container;
use Centum\Mvc\Router;

$container = new Container();

$router = $container->typehintClass(Router::class);
```

Methods can be called using the `typehintMethod()` method:

```php
use Centum\Container\Container;

$container = new Container();

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

$container = new Container();

$result = $container->typehintFunction("my_special_function");
```

The Container will handle all of the parameters.



## Specifying objects

Objects can be set using the `set()` method:

```php
use App\Console\Application;
use App\Mvc\Router;
use Centum\Container\Container;

$container = new Container();

$container->set(Application::class, new Application());
$container->set(Router::class, new Router());
```

You can then retrieve them with the `typehintClass()` method:

```php
use App\Console\Application;

/**
 * @var Application
 */
$application = $container->typehintClass(Application::class);
```

If the Container is unable to resolve a parameter, it will throw a [`Centum\Container\Exception\UnresolvableParamterException`](https://github.com/SidRoberts/centum/blob/development/src/Container/Exception/UnresolvableParamterException.php).
