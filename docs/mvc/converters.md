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
use Centum\Mvc\Exception\RouteNotFoundException;
use Doctrine\ORM\EntityManager;

class PostConverter implements ConverterInterface
{
    public function convert(string $id, Container $container) : Post
    {
        /**
         * @var EntityManager
         */
        $doctrine = $container->get("doctrine");

        $postRepository = $doctrine->getRepository(
            Post::class
        );

        $post = $postRepository->find($id) ?? throw new RouteNotFoundException();

        return $post;
    }
}
```

By throwing [`Centum\Mvc\Exception\RouteNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Mvc/Exception/RouteNotFoundException.php), you can tell the Router that this Route does not match and it will continue iterating through the other Routes.
In the above example, if the `App\Model\Post` object cannot be found in the database, this exception is thrown to avoid having to deal with it in the Route's `execute()` method.
When this exception is thrown, the Router understands that to mean that this Route isn't suitable and will continue iterating through the remaining Routes to find another match.

```php
use App\Converter\PostConverter;
use App\Model\Post;
use Centum\Container\Container;
use Centum\Http\Request;
use Centum\Http\Response;
use Centum\Mvc\Route;

class ViewSingleRoute extends Route
{
    public function getUri() : string
    {
        return "/post/{post:int}";
    }

    public function getConverters() : array
    {
        return [
            "post" => new PostConverter(),
        ];
    }

    public function execute(Request $request, Container $container, array $params) : Response
    {
        /**
         * @var Post
         */
        $post = $params["post"];

        //TODO Do something with the $post object.
        return new Response(
            $post->getTitle()
        );
    }
}
```
