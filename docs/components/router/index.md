---
layout: default
title: Router
parent: Components
has_children: true
permalink: router
---



# `Centum\Router`

MVC web apps can be created using [`Centum\Router\Router`](https://github.com/SidRoberts/centum/blob/main/src/Router/Router.php).

```php
Centum\Router\Router(
    Centum\Interfaces\Container\ContainerInterface $container
);
```

{: .highlight }
[`Centum\Router\Router`](https://github.com/SidRoberts/centum/blob/main/src/Router/Router.php) implements [`Centum\Interfaces\Router\RouterInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Router/RouterInterface.php).

The Router is the central component that connects incoming HTTP requests to the appropriate controller logic, and returns a HTTP response.
Essentially, its job is to convert a [`Centum\Interfaces\Http\RequestInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/RequestInterface.php) object into a [`Centum\Interfaces\Http\ResponseInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/ResponseInterface.php) object:

```php
$response = $router->handle($request);
```



## How It Works

1. The Router extracts the Request's URI and HTTP method.
2. It then iterates through the registered Routes until it finds a matching route.
3. Once a match is found, the Router instantiates the corresponding Controller, injects any required dependencies via the Container, and executes the Controller's action method.
4. The Controller then returns a Response object, which the Router passes back to the client.
