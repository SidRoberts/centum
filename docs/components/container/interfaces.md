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



## [`Centum\Interfaces\Container\AliasManagerInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Container/AliasManagerInterface.php)

```php
add(
    class-string $class,
    class-string $alias
): void
```

```php
get(
    class-string $class
): class-string
```

```php
has(
    class-string $class
): bool
```

```php
remove(
    class-string $class
): void
```

```php
getAll(): array<class-string, class-string>
```



## [`Centum\Interfaces\Container\ContainerInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Container/ContainerInterface.php)

```php
getAliasManager(): Centum\Interfaces\Container\AliasManagerInterface
```

```php
getResolverGroup(): Centum\Interfaces\Container\ResolverGroupInterface
```

```php
getObjectStorage(): Centum\Interfaces\Container\ObjectStorageInterface
```

```php
getServiceStorage(): Centum\Interfaces\Container\ServiceStorageInterface
```

```php
get(
    class-string<T> $class
): T
```

```php
typehintService(
    class-string<Centum\Interfaces\Container\ServiceInterface<T>> $serviceClass
): T
```

```php
typehintClass(
    class-string<T> $class
): T
```

```php
typehintMethod(
    object $class,
    non-empty-string $methodName
): mixed
```

```php
typehintFunction(
    Closure|callable-string $function
): mixed
```



## [`Centum\Interfaces\Container\ObjectStorageInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Container/ObjectStorageInterface.php)

```php
has(
    class-string $class
): bool
```

```php
get(
    class-string<T> $class
): T|null
```

```php
set(
    class-string<T> $class,
    T $object
): void
```

```php
remove(
    class-string $class
): void
```



## [`Centum\Interfaces\Container\ParameterInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Container/ParameterInterface.php)

```php
hasType(): bool
```

```php
getType(): ?non-empty-string
```

```php
isObject(): bool
```

```php
hasName(): bool
```

```php
getName(): ?non-empty-string
```

```php
allowsNull(): bool
```

```php
hasDefaultValue(): bool
```

```php
getDefaultValue(): mixed
```

```php
hasDeclaringClass(): bool
```

```php
getDeclaringClass(): ?class-string
```



## [`Centum\Interfaces\Container\ResolverGroupInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Container/ResolverGroupInterface.php)

```php
add(
    Centum\Interfaces\Container\ResolverInterface $resolver
): void
```

```php
remove(
    Centum\Interfaces\Container\ResolverInterface $resolver
): void
```

```php
resolve(
    Centum\Interfaces\Container\ParameterInterface $parameter,
    Centum\Interfaces\Container\ContainerInterface $container
): mixed
```



## [`Centum\Interfaces\Container\ResolverInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Container/ResolverInterface.php)

```php
resolve(
    Centum\Interfaces\Container\ParameterInterface $parameter
): mixed
```



## [`Centum\Interfaces\Container\ServiceInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Container/ServiceInterface.php)

```php
build(): T
```



## [`Centum\Interfaces\Container\ServiceStorageInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Container/ServiceStorageInterface.php)

```php
has(
    class-string $class
): bool
```

```php
get(
    class-string<T> $class
): class-string<ServiceInterface<T>>|null
```

```php
set(
    class-string<T> $class,
    class-string<Centum\Interfaces\Container\ServiceInterface<T>> $service
): void
```

```php
remove(
    class-string $class
): void
```
