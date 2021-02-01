---
layout: default
title: Converters
parent: Console
---



Converters are particularly useful at preprocessing command parameters - for example, converting an ID number into an actual object.
Any Converters you create must implement [`Centum\Console\ConverterInterface`](https://github.com/SidRoberts/centum/blob/development/src/Console/ConverterInterface.php).

```php
namespace App\Converter;

use App\Model\Post;
use Centum\Console\ConverterInterface;
use Centum\Console\Exception\CommandNotFoundException;
use Centum\Container\Container;
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

        $post = $postRepository->find($id) ?? throw new CommandNotFoundException();

        return $post;
    }
}
```

By throwing [`Centum\Console\Exception\CommandNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/CommandNotFoundException.php), you can tell the Application that this Command does not match.
In the above example, if the `App\Model\Post` object cannot be found in the database, this exception is thrown to avoid having to deal with it in the Command's `execute()` method.
When this exception is thrown, the Application understands that to mean that this Command isn't suitable and will fail.

```php
use App\Converter\PostConverter;
use App\Model\Post;
use Centum\Console\Command;
use Centum\Console\Terminal;
use Centum\Container\Container;

class PostDetailsCommand extends Command
{
    public function getName() : string
    {
        return "post-details";
    }

    public function getConverters() : array
    {
        return [
            "post" => new PostConverter(),
        ];
    }

    public function execute(Terminal $terminal, Container $container, array $params) : int
    {
        /**
         * @var Post
         */
        $post = $params["post"];

        $terminal->writeLine(
            $post->getTitle()
        );

        $terminal->writeLine(
            $post->getBody()
        );

        return 0;
    }
}
```
