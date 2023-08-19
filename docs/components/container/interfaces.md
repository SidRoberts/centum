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

- `get(string $class): object`
- `typehintMethod(object $class, string $methodName): mixed`
- `typehintFunction(Closure|string $function): mixed`
- `addAlias(string $interface, string $alias): void`
- `set(string $interface, object $object): void`
- `setDynamic(string $interface, Closure|string $function): void`
- `remove(string $interface): void`
- `addResolver(Centum\Interfaces\Container\ResolverInterface $resolver): void`



## [`Centum\Interfaces\Container\ResolverInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Container/ResolverInterface.php)

- `resolve(ReflectionParameter $parameter): mixed`
