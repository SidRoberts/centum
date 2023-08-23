---
layout: default
title: Interfaces
parent: Container
grand_parent: Components
permalink: container/interfaces
nav_order: 102
---



# Interfaces

(all in the `Centum\Interfaces\Container` namespace)



## [`Centum\Interfaces\Container\ContainerInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Container/ContainerInterface.php)

```php
get(
    interface-string<T>|class-string<T> $class
): T
```

```php
typehintMethod(
    object $class,
    string $methodName
): mixed
```

```php
typehintFunction(
    Closure|callable-string $function
): mixed
```

```php
addAlias(
    interface-string $interface,
    class-string $alias
): void
```

```php
set(
    interface-string $interface,
    object $object
): void
```

```php
setDynamic(
    interface-string $interface,
    Closure|callable-string $function
): void
```

```php
remove(
    interface-string $interface
): void
```

```php
addResolver(
    Centum\Interfaces\Container\ResolverInterface $resolver
): void
```



## [`Centum\Interfaces\Container\ResolverInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Container/ResolverInterface.php)

```php
resolve(
    ReflectionParameter $parameter
): mixed
```
