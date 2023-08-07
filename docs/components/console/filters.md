---
layout: default
title: Filters
parent: Console
grand_parent: Components
permalink: console/filters
---



# Filters

Filters are particularly useful at preprocessing command parameters - for example, converting an ID number into an actual object.
Any Filters you create must implement [`Centum\Interfaces\Filter\FilterInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Filter/FilterInterface.php).

```php
namespace App\Filters;

use App\Models\Post;
use Centum\Console\Exception\CommandNotFoundException;
use Centum\Interfaces\Filter\FilterInterface;
use Doctrine\ORM\EntityManagerInterface;

class PostFilter implements FilterInterface
{
    public function __construct(
        protected readonly EntityMangerInterface $entityManager
    ) {
    }

    public function filter(mixed $value): Post
    {
        $postRepository = $this->entityManager->getRepository(
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
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;

class PostDetailsCommand extends Command
{
    public function getName(): string
    {
        return "post-details";
    }

    public function getFilters(ContainerInterface $container): array
    {
        return [
            "post" => $container->get(PostFilter::class),
        ];
    }

    public function execute(TerminalInterface $terminal, ContainerInterface $container, ParametersInterface $parameters): int
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
