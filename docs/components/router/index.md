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
Centum\Router\Router(
    Centum\Interfaces\Container\ContainerInterface $container
);
```

{: .highlight }
[`Centum\Router\Router`](https://github.com/SidRoberts/centum/blob/development/src/Router/Router.php) implements [`Centum\Interfaces\Router\RouterInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Router/RouterInterface.php).

The Router's job is to convert a [`Centum\Interfaces\Http\RequestInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/RequestInterface.php) object into a [`Centum\Interfaces\Http\ResponseInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Http/ResponseInterface.php) object:

```php
$response = $router->handle($request);
```

It does so by extracting the Request's URI and method, it iterates through the Routes until it finds one that matches, and then executes the Controller's code which returns a Response.



## Exceptions

(all in the `Centum\Router\Exception` namespace)

- [`ParamNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Router/Exception/ParamNotFoundException.php)
- [`RouteMismatchException`](https://github.com/SidRoberts/centum/blob/development/src/Router/Exception/RouteMismatchException.php)
- [`RouteNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Router/Exception/RouteNotFoundException.php)
