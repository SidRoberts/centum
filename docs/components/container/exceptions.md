---
layout: default
title: Exceptions
parent: Container
grand_parent: Components
permalink: container/exceptions
nav_order: 101
---



# Exceptions

(all in the `Centum\Container\Exception` namespace)



## [`CookieNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Container/Exception/CookieNotFoundException.php)

Thrown in:

- [`Centum\Container\Resolver\RequestResolver::resolve()`](https://github.com/SidRoberts/centum/blob/development/src/Container/Resolver/RequestResolver.php#L32)



## [`FileGroupNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Container/Exception/FileGroupNotFoundException.php)

Thrown in:

- [`Centum\Container\Resolver\RequestResolver::resolve()`](https://github.com/SidRoberts/centum/blob/development/src/Container/Resolver/RequestResolver.php#L32)



## [`FormFieldNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Container/Exception/FormFieldNotFoundException.php)

Thrown in:

- [`Centum\Container\Resolver\FormResolver::resolve()`](https://github.com/SidRoberts/centum/blob/development/src/Container/Resolver/FormResolver.php#L25)



## [`InstantiateInterfaceException`](https://github.com/SidRoberts/centum/blob/development/src/Container/Exception/InstantiateInterfaceException.php)

Thrown in:

- [`Centum\Container\Container::get()`](https://github.com/SidRoberts/centum/blob/development/src/Container/Container.php#L76)
- [`Centum\Container\Container::typehintService()`](https://github.com/SidRoberts/centum/blob/development/src/Container/Container.php#L96)
- [`Centum\Container\Container::typehintClass()`](https://github.com/SidRoberts/centum/blob/development/src/Container/Container.php#L115)



## [`UnresolvableParameterException`](https://github.com/SidRoberts/centum/blob/development/src/Container/Exception/UnresolvableParameterException.php)

Thrown in:

- [`Centum\Container\ResolverGroup::resolve()`](https://github.com/SidRoberts/centum/blob/development/src/Container/ResolverGroup.php#L43)
- [`Centum\Container\Resolver\ConsoleResolver::resolve()`](https://github.com/SidRoberts/centum/blob/development/src/Container/Resolver/ConsoleResolver.php#L25)
- [`Centum\Container\Resolver\FormResolver::resolve()`](https://github.com/SidRoberts/centum/blob/development/src/Container/Resolver/FormResolver.php#L25)
- [`Centum\Container\Resolver\RequestResolver::resolve()`](https://github.com/SidRoberts/centum/blob/development/src/Container/Resolver/RequestResolver.php#L32)
- [`Centum\Container\Resolver\RouterParametersResolver::resolve()`](https://github.com/SidRoberts/centum/blob/development/src/Container/Resolver/RouterParametersResolver.php#L24)



## [`UnsupportedParameterTypeException`](https://github.com/SidRoberts/centum/blob/development/src/Container/Exception/UnsupportedParameterTypeException.php)

Thrown in:

- [`Centum\Container\Container::typehintService()`](https://github.com/SidRoberts/centum/blob/development/src/Container/Container.php#L96)
- [`Centum\Container\Container::typehintClass()`](https://github.com/SidRoberts/centum/blob/development/src/Container/Container.php#L115)
- [`Centum\Container\Container::typehintMethod()`](https://github.com/SidRoberts/centum/blob/development/src/Container/Container.php#L140)
- [`Centum\Container\Container::typehintFunction()`](https://github.com/SidRoberts/centum/blob/development/src/Container/Container.php#L154)
- [`Centum\Container\Container::resolveParams()`](https://github.com/SidRoberts/centum/blob/development/src/Container/Container.php#L170)
