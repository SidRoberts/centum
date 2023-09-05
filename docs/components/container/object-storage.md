---
layout: default
title: Object Storage
parent: Container
grand_parent: Components
permalink: container/object-storage
nav_order: 3
---



# Object Storage

Within a Container, objects are stored in an [`ObjectStorageInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Container/ObjectStorageInterface.php) instance.

```php
Centum\Container\ObjectStorage();
```

{: .highlight }
[`Centum\Container\ObjectStorage`](https://github.com/SidRoberts/centum/blob/development/src/Container/ObjectStorage.php) implements [`Centum\Interfaces\Container\ObjectStorageInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Container/ObjectStorageInterface.php).

You can obtain the Object Storage from a Container:

```php
use Centum\Interfaces\Container\ContainerInterface;

/** @var ContainerInterface $container */

$objectStorage = $container->getObjectStorage();
```



## Checking if an object exists

You can check if objects exist using the `has()` method:

```php
use Centum\Interfaces\Container\ObjectStorageInterface;
use Centum\Interfaces\Router\RouterInterface;

/** @var ObjectStorageInterface $objectStorage */

if ($objectStorage->has(RouterInterface::class)) {
    echo "There is a `RouterInterface` in the object storage.";
} else {
    echo "`RouterInterface` is not in the object storage.";
}
```

If the object does not exist, then `null` will be returned.



## Retrieving objects

Objects can be retreived using the `get()` method:

```php
use Centum\Interfaces\Container\ObjectStorageInterface;
use Centum\Interfaces\Router\RouterInterface;

/** @var ObjectStorageInterface $objectStorage */

$router = $objectStorage->get(RouterInterface::class);
```

If the object does not exist, then `null` will be returned.



## Specifying objects

Objects can be set using the `set()` method:

```php
use Centum\Clock\Clock;
use Centum\Interfaces\Container\ObjectStorageInterface;
use Centum\Interfaces\Clock\ClockInterface;

/** @var ObjectStorageInterface $objectStorage */

$clock = new Clock();

$objectStorage->set(ClockInterface::class, $clock);
```



## Removing objects

You can remove objects using the `remove()` method:

```php
use Centum\Interfaces\Container\ObjectStorageInterface;
use Centum\Interfaces\Router\RouterInterface;

/** @var ObjectStorageInterface $objectStorage */

$objectStorage->remove(RouterInterface::class);
```
