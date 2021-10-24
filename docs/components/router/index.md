---
layout: default
title: Router
parent: Components
has_children: true
permalink: router
---



# `Centum\Router`

MVC web apps can be created using [`Centum\Router\Router`](https://github.com/SidRoberts/centum/blob/development/src/Router/Router.php).

```php
use Centum\Container\Container;
use Centum\Router\Router;

$container = new Container();

$router = new Router($container);
```

The Router's job is to convert a HTTP [Request](https://github.com/SidRoberts/centum/blob/development/src/Http/Request.php) object into a HTTP [Response](https://github.com/SidRoberts/centum/blob/development/src/Http/Response.php) object:

```php
$response = $router->handle($request);
```

It does so by extracting the Request's URI and method, it iterates through the Routes until it finds one that matches, and then executes the Controller's code which returns a Response.