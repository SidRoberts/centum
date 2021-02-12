---
layout: default
title: Container
has_children: true
permalink: container
---



# `Centum\Container`

The Container component handles object dependencies.
It allows you to centralise object creation and reuse them in various parts of your project.

A very simplistic approach involves setting objects using the `set()` method:

```php
use App\Config;
use App\Router;
use Centum\Container\Container;

$container = new Container();

$container->set("config", new Config());
$container->set("router", new Router());
```

You can then retrieve them with the `get()` method:

```php
/**
 * @var Config
 */
$config = $container->get("config");
```

If an object does not exist, `get()` will throw a [`Centum\Container\Exception\ServiceNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Container/Exception/ServiceNotFoundException.php).

You can also check if a service exists using `has()` which will return a boolean:

```php
if ($container->has("config")) {
    echo "Yay!";
} else {
    echo "'config' could not be found in the Container.";
}
```
