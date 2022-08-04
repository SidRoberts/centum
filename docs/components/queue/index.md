---
layout: default
title: Queue
parent: Components
has_children: true
permalink: queue
---



# `Centum\Queue`

The Queue component acts as a very simple and focussed frontend for [Beanstalkd](https://beanstalkd.github.io/).
It is solely designed for offloading work so that it can be processed elsewhere.
This is especially useful for tasks that could take a long time, be hardware intensive, or otherwise negatively affect the application's performance.

[`Centum\Queue\Queue`](https://github.com/SidRoberts/centum/tree/development/src/Queue/Queue.php) features two public methods:

* `publish()`
* `consume()`

Both methods work with the abstract [`Centum\Queue\Task`](https://github.com/SidRoberts/centum/tree/development/src/Queue/Task.php) class which represents a piece of work that a background worker can execute:

```php
namespace App\Tasks;

use Centum\Container\Container;
use Centum\Queue\Task;

class LogTask extends Task
{
    protected string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function execute(Container $container): void
    {
        $line = sprintf(
            "[%s] %s" . PHP_EOL,
            date("Y-m-d H:i:s"),
            $this->message
        );

        file_put_contents("log.txt", $line, FILE_APPEND);
    }
}
```

This Task can be published from anywhere and consumed from anywhere else in your code.
One typical use case is publishing a Task from within a Controller and then consuming it in a Command:

```php
namespace App\Controllers;

use App\Tasks\LogTask;
use Centum\Http\Response;
use Centum\Queue\Queue;

class IndexController
{
    public function index(Queue $queue): Response
    {
        $queue->publish(new LogTask("Queue works OK."));

        return new Response("hello");
    }
}
```

```php
namespace App\Commands;

use Centum\Console\Command;
use Centum\Console\Parameters;
use Centum\Console\Terminal;
use Centum\Container\Container;
use Centum\Queue\Queue;

class QueueConsumeCommand extends Command
{
    public function getName(): string
    {
        return "queue-consume";
    }

    public function execute(Terminal $terminal, Container $container, Parameters $parameters): int
    {
        /** @var Queue */
        $queue = $container->typehintClass(Queue::class);

        $queue->consume();

        return 0;
    }
}
```
