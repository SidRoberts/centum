---
layout: default
title: Filters
parent: Mvc
grand_parent: Apps
---



# Filters

Filters are particularly useful at preprocessing URL parameters - for example, converting an ID number into an actual object.
Any Filters you create must implement [`Centum\Filter\FilterInterface`](https://github.com/SidRoberts/centum/blob/development/src/Filter/FilterInterface.php).

```php
namespace App\Filter;

use App\Model\Post;
use Centum\Container\Container;
use Centum\Filter\FilterInterface;
use Centum\Mvc\Exception\RouteMismatchException;
use Doctrine\ORM\EntityManager;

class IdToPostFilter implements FilterInterface
{
    protected Container $container;



    public function __construct(Container $container)
    {
        $this->container = $container;
    }



    public function filter(mixed $value): Post
    {
        /**
         * @var EntityManager
         */
        $doctrine = $this->container->typehintClass(EntityManager::class);

        $postRepository = $doctrine->getRepository(
            Post::class
        );

        $post = $postRepository->find($value) ?? throw new RouteMismatchException();

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
    public function view(Parameters $parameters): Response
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
use App\Filter\IdToPostFilter;

$router->get("/post/{post:int}", PostController::class, "view")
    ->addFilter(
        "post",
        new IdToPostFilter($container)
    );
```
