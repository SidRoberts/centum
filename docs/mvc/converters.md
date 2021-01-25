---
layout: default
title: Converters
parent: Mvc
---



Converters are particularly useful at preprocessing URL parameters - for example, converting an ID number into an actual object.
Any Converters you create must implement [`Centum\Mvc\ConverterInterface`](https://github.com/SidRoberts/centum/blob/development/src/Mvc/ConverterInterface.php) and you can inject any services you require via the constructor.

```php
namespace App\Converter;

use App\Model\Post;
use Centum\Mvc\ConverterInterface;
use Centum\Mvc\Router\Exception\RouteNotFoundException;
use Doctrine\ORM\EntityManager;

class PostConverter implements ConverterInterface
{
    protected EntityManager $doctrine;



    public function __construct(EntityManager $doctrine)
    {
        $this->doctrine = $doctrine;
    }



    public function convert(string $id) : Post
    {
        $postRepository = $this->doctrine->getRepository(
            Post::class
        );

        $post = $postRepository->find($id);

        if (!$post) {
            throw new RouteNotFoundException();
        }

        return $post;
    }
}
```

By throwing [`Centum\Mvc\Router\Exception\RouteNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Mvc/Router/Exception/RouteNotFoundException.php), you can trigger a 404 error.
In the above example, if the `App\Model\Post` object cannot be found in the database, this exception is thrown to avoid having to deal with it in the action method.

```php
use App\Converter\PostConverter;
use App\Model\Post;
use Centum\Mvc\Parameters;
use Centum\Mvc\Router\Route\Uri;
use Centum\Mvc\Router\Route\Requirement;
use Centum\Mvc\Router\Route\Converter;

#[Uri("/post/{post}")]
#[Requirement("post", "\d+")]
#[Converter("post", PostConverter::class)]
public function viewSingle(Parameters $parameters)
{
    /**
     * @var Post
     */
    $post = $parameters->get("post");

    //TODO Do something with the $post object.
}
```
