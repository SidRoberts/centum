---
layout: default
title: Resolvers
parent: Container
grand_parent: Components
permalink: container/resolvers
nav_order: 2
---



# Resolvers

A Resolver takes a parameter from a method or a function and tries to resolve it into an object or a value.
Resolved values/objects are not stored in the Container unless the Resolver specifically adds it to the Object Storage.

{: .note }
Resolvers must implement [`Centum\Interfaces\Container\ResolverInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Container/ResolverInterface.php).

Centum has the following Resolvers:

- [`ConsoleResolver`](https://github.com/SidRoberts/centum/blob/development/src/Container/Resolver/ConsoleResolver.php) - provides Terminal arguments to [Commands](../console/commands.md). See [Command Arguments](../console/commands.md#command-arguments).
- [`FormResolver`](https://github.com/SidRoberts/centum/blob/development/src/Container/Resolver/FormResolver.php) - provides direct access to GET/POST values to [Forms](../http/forms.md).
- [`RequestResolver`](https://github.com/SidRoberts/centum/blob/development/src/Container/Resolver/RouterRequestResolver.php) - provides direct access to objects within a Request as well as individual [Cookie](../http/cookies.md) and [FileGroup](../http/files.md) objects.
- [`RouterParametersResolver`](https://github.com/SidRoberts/centum/blob/development/src/Container/Resolver/RouterParametersResolver.php) - provides [Route Parameters](../router/dynamic-urls.md) to [Controllers](../router/routes.md).



## Resolver Group

The Resolver Group is responsible for storing all of the Resolvers and iterating through them to find a possible value.
After all the Resolvers have been tried, the Resolver Group which will try to find or create an object from the Container.

```php
Centum\Container\ResolverGroup();
```

{: .highlight }
[`Centum\Container\ResolverGroup`](https://github.com/SidRoberts/centum/blob/development/src/Container/ResolverGroup.php) implements [`Centum\Interfaces\Container\ResolverGroupInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Container/ResolverGroupInterface.php).

You can obtain the Resolver Group from a Container:

```php
use Centum\Interfaces\Container\ContainerInterface;

/** @var ContainerInterface $container */

$resolverGroup = $container->getResolverGroup();
```
