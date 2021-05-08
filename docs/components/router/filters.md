---
layout: default
title: Filters
parent: Router
grand_parent: Components
---



# Filters

Filters are particularly useful at preprocessing URL parameters - for example, converting an ID number into an actual object.
Any Filters you create must implement [`Centum\Filter\FilterInterface`](https://github.com/SidRoberts/centum/blob/development/src/Filter/FilterInterface.php).

```php
namespace App\Filters;

use App\Models\Post;
use Centum\Container\Container;
use Centum\Filter\FilterInterface;
use Centum\Router\Exception\RouteMismatchException;
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

In the above example, if the `App\Models\Post` object cannot be found in the database, [`Centum\Router\Exception\RouteMismatchException`](https://github.com/SidRoberts/centum/blob/development/src/Router/Exception/RouteMismatchException.php) is thrown to avoid having to deal with it in the Route's `execute()` method.
When this exception is thrown, the Router understands that to mean that this Route isn't suitable and will continue iterating through the remaining Routes to find another match.

```php
namespace App\Controllers;

use App\Models\Post;
use Centum\Http\Response;
use Centum\Router\Parameters;

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
use App\Controllers\PostController;
use App\Filters\IdToPostFilter;

$group->get("/post/{post:int}", PostController::class, "view")
    ->addFilter(
        "post",
        new IdToPostFilter($container)
    );
```
