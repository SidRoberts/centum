---
layout: default
title: Replacements
parent: Router
grand_parent: Components
permalink: router/replacements
---



# Replacements

Replacements are particularly useful at preprocessing URL parameters - for example, converting an ID number into an actual object.
Any Replacements you create must implement [`Centum\Interfaces\Router\ReplacementInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Router/ReplacementInterface.php).

```php
namespace App\Replacements;

use App\Models\Post;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Router\ReplacementInterface;
use Centum\Router\Exception\RouteMismatchException;
use Doctrine\ORM\EntityManagerInterface;

class PostReplacement implements ReplacementInterface
{
    public function __construct(
        protected readonly EntityManagerInterface $entityManager
    ) {
    }



    public function getIdentifer(): string
    {
        return "Post";
    }

    public function getRegularExpression(): string
    {
        return "\d+";
    }

    public function filter(string $value): Post
    {
        $postRepository = $this->entityManager->getRepository(
            Post::class
        );

        $post = $postRepository->find($value) ?? throw new RouteMismatchException();

        return $post;
    }
}
```

In the above example, if the `App\Models\Post` object cannot be found in the database, [`Centum\Router\Exception\RouteMismatchException`](https://github.com/SidRoberts/centum/blob/development/src/Router/Exception/RouteMismatchException.php) is thrown to avoid having to deal with it in the Controller.
When this exception is thrown, the Router understands that to mean that this Route isn't suitable and will continue iterating through the remaining Routes to find another match.

When setting the Routes in the Router a Replacement can be added and Routes can reference its identifier (in this case `Post`):

```php
use App\Controllers\PostController;
use App\Replacements\PostReplacement;
use Doctrine\ORM\EntityManagerInterface;

/** @var EntityManagerInterface $entityManager */

$router->addReplacement(
    new PostReplacement($entityManager)
);

$group = $router->group();

$group->get("/post/{post:Post}", PostController::class, "view");
```

Now, the Controller has access to the Post object:

```php
namespace App\Controllers;

use App\Models\Post;
use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ParametersInterface;

class PostController
{
    public function view(ParametersInterface $parameters): ResponseInterface
    {
        /** @var Post */
        $post = $parameters->get("post");

        //TODO Do something with the $post object.

        return new Response(
            $post->getTitle()
        );
    }
}
```
