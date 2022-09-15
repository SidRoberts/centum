---
layout: default
title: Filters
parent: Console
grand_parent: Components
permalink: console/filters
---



# Filters

Filters are particularly useful at preprocessing command parameters - for example, converting an ID number into an actual object.
Any Filters you create must implement [`Centum\Filter\FilterInterface`](https://github.com/SidRoberts/centum/blob/development/src/Filter/FilterInterface.php).

```php
namespace App\Filters;

use App\Models\Post;
use Centum\Console\Exception\CommandNotFoundException;
use Centum\Container\Container;
use Centum\Filter\FilterInterface;
use Doctrine\ORM\EntityManager;

class PostFilter implements FilterInterface
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function filter(mixed $value): Post
    {
        $doctrine = $this->container->typehintClass(EntityManager::class);

        $postRepository = $doctrine->getRepository(
            Post::class
        );

        $post = $postRepository->find($value) ?? throw new CommandNotFoundException();

        return $post;
    }
}
```

By throwing [`Centum\Console\Exception\CommandNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Console/Exception/CommandNotFoundException.php), you can tell the Application that this Command does not match.
In the above example, if the `App\Model\Post` object cannot be found in the database, this exception is thrown to avoid having to deal with it in the Command's `execute()` method.
When this exception is thrown, the Application understands that to mean that this Command isn't suitable and will fail.

```php
namespace App\Commands;

use App\Filters\PostFilter;
use App\Models\Post;
use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;

class PostDetailsCommand extends Command
{
    public function getName(): string
    {
        return "post-details";
    }

    public function getFilters(Container $container): array
    {
        return [
            "post" => new PostFilter($container),
        ];
    }

    public function execute(Terminal $terminal, Container $container, Parameters $parameters): int
    {
        /** @var Post */
        $post = $parameters->get("post");

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
