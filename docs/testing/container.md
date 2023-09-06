---
layout: default
title: Container Actions
parent: Testing
permalink: testing/container
---



# Container Actions

[`Centum\Codeception\Actions\ContainerActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/ContainerActions.php)



## `grabContainerObjectStorage`

```php
grabContainerObjectStorage(): Centum\Interfaces\Container\ObjectStorageInterface
```



## `grabFromContainer`

```php
grabFromContainer(
    class-string<T> $class
): T
```



## `addToContainer`

```php
addToContainer(
    class-string<T> $class,
    T $object
): void
```



## `removeFromContainer`

Remove an object from the Container.

```php
removeFromContainer(
    class-string $class
): void
```



## `mockInContainer`

```php
mockInContainer(
    class-string<T> $class,
    callable $callable = null
): T
```
