---
layout: default
title: Replacements
parent: Router
grand_parent: Components
permalink: router/replacements
nav_order: 4
---



# Replacements

Replacements in Centum are particularly useful for preprocessing URL parameters before they reach your controller methods.
They allow you to transform raw URL data, such as an ID number, into a fully usable object.
This can greatly simplify your controllers by offloading validation and data retrieval responsibilities to a dedicated class.

{: .note }
Replacements must implement [`Centum\Interfaces\Router\ReplacementInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Router/ReplacementInterface.php).

Here’s an example of a Replacement that converts a numeric post ID into a `Post` object from the database:

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

    public function process(string $value): Post
    {
        $postRepository = $this->entityManager->getRepository(
            Post::class
        );

        $post = $postRepository->find($value) ?? throw new RouteMismatchException();

        return $post;
    }
}
```

In this example, the `process()` method retrieves a `Post` object based on the numeric value provided in the URL.
If no matching `Post` is found, the method throws [`Centum\Router\Exception\RouteMismatchException`](https://github.com/SidRoberts/centum/blob/main/src/Router/Exception/RouteMismatchException.php).
This exception signals to the Router that the current route does not match, allowing it to continue checking other routes instead of handling the error within the controller.
This helps keep your controller code clean and focused only on business logic.

When setting up your routes, you can register a Replacement with the Router.
Then, routes can reference the Replacement’s identifier (in this case `Post`) to automatically convert URL parameters:

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

With this setup, the `{post:Post}` parameter in the route URL will only match integers and is automatically replaced with a `Post` object, which is then injected into the controller method.

{: .note }
It's good practice to capitalise replacement identifiers for models or PHP objects and use lowercase for basic scalar values.

In the controller, you can now work directly with fully-formed `Post` objects without having to manually fetch or validate them:

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
        return new Response(
            $post->getTitle()
        );
    }
}
```

By using Replacements, you can ensure that:

1. Your controllers remain clean and focused on business logic.
2. URL parameter handling is consistent and reusable across multiple routes.
3. Routes are more descriptive, and developers can easily understand what type of object is expected.
4. Your application can gracefully handle missing or optional parameters without excessive error handling in controllers.
