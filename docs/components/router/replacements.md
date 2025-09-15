---
layout: default
title: Replacements
parent: Router
grand_parent: Components
permalink: router/replacements
nav_order: 4
---



# Replacements

Replacements are particularly useful at preprocessing URL parameters - for example, converting an ID number into an actual object.

{: .note }
Replacements must implement [`Centum\Interfaces\Router\ReplacementInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Router/ReplacementInterface.php).

```php
namespace App\Web\Replacements;

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



    public function getIdentifier(): string
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

In the above example, if the `App\Models\Post` object cannot be found in the database, [`Centum\Router\Exception\RouteMismatchException`](https://github.com/SidRoberts/centum/blob/main/src/Router/Exception/RouteMismatchException.php) is thrown to avoid having to deal with it in the Controller.
When this exception is thrown, the Router understands that to mean that this Route isn't suitable and will continue iterating through the remaining Routes to find another match.

When setting the Routes in the Router a Replacement can be added and Routes can reference its identifier (in this case `Post`):

```php
use App\Web\Controllers\PostController;
use App\Web\Replacements\PostReplacement;
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
namespace App\Web\Controllers;

use App\Models\Post;
use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

class PostController implements ControllerInterface
{
    public function view(Post $post): ResponseInterface
    {
        //TODO Do something with the $post object.

        return new Response(
            $post->getTitle()
        );
    }
}
```
