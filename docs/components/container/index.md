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

The Container is made up of four parts:

- Alias Manager
- Resolver Group
- Object Storage
- Service Storage

```php
Centum\Container\Container(
    Centum\Interfaces\Container\AliasManagerInterface $aliasManager = null,
    Centum\Interfaces\Container\ResolverGroupInterface $resolverGroup = null,
    Centum\Interfaces\Container\ObjectStorageInterface $objectStorage = null,
    Centum\Interfaces\Container\ServiceStorageInterface $serviceStorage = null
);
```

If any of these parts are not explicitly set, then the Container will create a default for that part.

{: .highlight }
[`Centum\Container\Container`](https://github.com/SidRoberts/centum/blob/main/src/Container/Container.php) implements [`Centum\Interfaces\Container\ContainerInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Container/ContainerInterface.php).

```php
use Centum\Container\Container;

$container = new Container();
```



## Retrieving objects

Classes can be retreived using the `get()` method:

```php
use Centum\Interfaces\Router\RouterInterface;

$router = $container->get(RouterInterface::class);
```

If the object does not exist within the Container, then a new instance will be created and returned.

If the Container is unable to resolve a parameter, it will throw a [`Centum\Container\Exception\UnresolvableParameterException`](https://github.com/SidRoberts/centum/blob/main/src/Container/Exception/UnresolvableParameterException.php).



## Links

- [Source code (`src/Container/`)](https://github.com/SidRoberts/centum/blob/main/src/Container/)
- [Interfaces (`src/Interfaces/Container/`)](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Container/)
- [Unit tests (`tests/Unit/Container/`)](https://github.com/SidRoberts/centum/blob/main/tests/Unit/Container/)
