---
layout: default
title: Web
parent: Apps
has_children: true
---



# Web Apps

MVC web apps can be created using [`Centum\Mvc\Router`](https://github.com/SidRoberts/centum/blob/development/src/Mvc/Router.php).

```php
use Centum\Container\Container;
use Centum\Mvc\Router;

$container = new Container();

$router = new Router($container);
```

The Router's job is to convert a HTTP [Request](https://github.com/SidRoberts/centum/blob/development/src/Http/Request.php) object into a HTTP [Response](https://github.com/SidRoberts/centum/blob/development/src/Http/Response.php) object:

```php
$response = $router->handle($request);
```

It does so by extracting the Request's URI and method, it iterates through the Routes until it finds one that matches, and then executes the Controller's code which returns a Response.
