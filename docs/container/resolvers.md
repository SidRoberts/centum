---
layout: default
title: Resolvers
parent: Container Component
permalink: container/resolvers
nav_order: 2
---



# Resolvers

A Resolver takes a parameter from a method or a function and tries to resolve it into an object or a value.
Resolved values/objects are not stored in the Container unless the Resolver specifically adds it to the Object Storage.
This ensures that Resolvers act only as a mechanism for returning values on demand, rather than silently polluting the Container with instances you did not intend to keep around.

{: .callout.info }
Resolvers must implement [`Centum\Interfaces\Container\ResolverInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Container/ResolverInterface.php).



## Resolver Group

As an application may have many different Resolvers working together, it's necessary to have a Resolver Group to manage them in a structured way.
The Resolver Group is responsible for storing all of the Resolvers and iterating through them to find a possible value.
Each Resolver is asked in order whether it can handle a particular parameter.
If it cannot, the next one in the chain is tried.

After all the Resolvers have been tried, the Resolver Group will then try to find or create an object from the Container.

```php
Centum\Container\ResolverGroup();
```

{: .callout.info }
[`Centum\Container\ResolverGroup`](https://github.com/SidRoberts/centum/blob/main/src/Container/ResolverGroup.php) implements [`Centum\Interfaces\Container\ResolverGroupInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Container/ResolverGroupInterface.php).

You can obtain the Resolver Group from a Container:

```php
use Centum\Interfaces\Container\ContainerInterface;

/** @var ContainerInterface $container */

$resolverGroup = $container->getResolverGroup();
```

You can add and remove Resolvers from the group at runtime, which makes it easy to adjust the behaviour of your application depending on the environment or context:

```php
$resolverGroup->add($resolver);
```

```php
$resolverGroup->remove($resolver);
```



## Built-In Resolvers

Centum comes with several built-in Resolvers so you don’t always need to write your own from scratch.
These are ready to use and cover the most common scenarios encountered when building applications:

- [`ConsoleResolver`](https://github.com/SidRoberts/centum/blob/main/src/Container/Resolver/ConsoleResolver.php) – provides Terminal arguments to [Commands](../console/commands.md). See [Command Arguments](../console/commands.md#command-arguments).
- [`FormResolver`](https://github.com/SidRoberts/centum/blob/main/src/Container/Resolver/FormResolver.php) – provides direct access to GET/POST values to [Forms](../http/forms.md).
- [`RequestResolver`](https://github.com/SidRoberts/centum/blob/main/src/Container/Resolver/RouterRequestResolver.php) – provides direct access to objects within a Request as well as individual [Cookie](../http/cookies.md) and [FileGroup](../http/files.md) objects.
- [`RouterParametersResolver`](https://github.com/SidRoberts/centum/blob/main/src/Container/Resolver/RouterParametersResolver.php) – provides [Route Parameters](../router/dynamic-urls.md) to [Controllers](../router/routes.md).

These Resolvers help keep your Controllers, Commands, and Forms lean by removing the need to manually extract data from requests or terminal inputs.



## Custom Resolvers

Sometimes you’ll need to resolve parameters that aren’t covered by the built-in Resolvers.
In those cases, you can write your own custom Resolver.

If your custom resolver is unable to resolve the parameter, throw [`Centum\Container\Exception\UnresolvableParameterException`](https://github.com/SidRoberts/centum/blob/main/src/Container/Exception/UnresolvableParameterException.php).
Throwing this exception signals to the Resolver Group that it should move on and try the next Resolver in the chain.
This approach makes it possible to smoothly integrate third-party libraries into the Centum dependency resolution system without hardcoding dependencies into your classes.

### Example: Doctrine Repository Resolver

Here’s an example Resolver that integrates [Doctrine repositories](https://www.doctrine-project.org/projects/orm.html) into Centum:

```php
<?php

namespace App\Resolvers;

use Centum\Container\Exception\UnresolvableParameterException;
use Centum\Interfaces\Container\ParameterInterface;
use Centum\Interfaces\Container\ResolverInterface;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineRepositoryResolver implements ResolverInterface
{
    public function __construct(
        protected EntityManagerInterface $entityManager
    ) {
    }

    /**
     * @throws UnresolvableParameterException
     */
    public function resolve(ParameterInterface $parameter): mixed
    {
        if (!$parameter->isObject()) {
            throw new UnresolvableParameterException($parameter);
        }

        $repositoryClassName = $parameter->getType();

        $metadataFactory = $this->entityManager->getMetadataFactory();

        foreach ($metadataFactory->getAllMetadata() as $metadata) {
            if ($metadata->customRepositoryClassName === $repositoryClassName) {
                $modelClassName = $metadata->getName();

                return $this->entityManager->getRepository($modelClassName);
            }
        }

        throw new UnresolvableParameterException($parameter);
    }
}
```

You can then register your Resolver with the group:

```php
use App\Resolvers\DoctrineRepositoryResolver;

$resolverGroup->add(DoctrineRepositoryResolver::class);
```

Now you can call a Doctrine repository:

```php
namespace App\Web\Controllers;

use App\Repositories\PostRepository;
use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

class PostController implements ControllerInterface
{
    public function total(PostRepository $postRepository): ResponseInterface
    {
        $count = $postRepository->count([]);

        return new Response("There are {$count} posts.");
    }
}
```

(`PostRepository` is not shown.)
