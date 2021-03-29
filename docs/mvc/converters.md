---
layout: default
title: Converters
parent: Mvc
---



# Converters

Converters are particularly useful at preprocessing URL parameters - for example, converting an ID number into an actual object.
Any Converters you create must implement [`Centum\Mvc\ConverterInterface`](https://github.com/SidRoberts/centum/blob/development/src/Mvc/ConverterInterface.php).

```php
namespace App\Converter;

use App\Model\Post;
use Centum\Container\Container;
use Centum\Mvc\ConverterInterface;
use Centum\Mvc\Exception\RouteMismatchException;
use Doctrine\ORM\EntityManager;

class PostConverter implements ConverterInterface
{
    public function convert(string $id, Container $container) : Post
    {
        /**
         * @var EntityManager
         */
        $doctrine = $container->typehintClass(EntityManager::class);

        $postRepository = $doctrine->getRepository(
            Post::class
        );

        $post = $postRepository->find($id) ?? throw new RouteMismatchException();

        return $post;
    }
}
```

In the above example, if the `App\Model\Post` object cannot be found in the database, [`Centum\Mvc\Exception\RouteMismatchException`](https://github.com/SidRoberts/centum/blob/development/src/Mvc/Exception/RouteMismatchException.php) is thrown to avoid having to deal with it in the Route's `execute()` method.
When this exception is thrown, the Router understands that to mean that this Route isn't suitable and will continue iterating through the remaining Routes to find another match.

```php
use App\Model\Post;
use Centum\Http\Response;
use Centum\Mvc\Parameters;

class PostController
{
    public function view(Parameters $parameters) : Response
    {
        /**
         * @var Post
         */
        $post = $parameters->get("post");

        //TODO Do something with the $post object.
        return new Response(
            $post->getTitle()
        );
    }
}
```

```php
use App\Converter\PostConverter;

$router->get("/post/{post:int}", PostController::class, "view")
    ->addConverter(
        "post",
        new PostConverter()
    );
```
