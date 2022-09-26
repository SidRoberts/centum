---
layout: default
title: Queue
parent: Components
has_children: false
permalink: queue
---



# `Centum\Queue`

The Queue component acts as a very simple and focussed frontend for [Beanstalkd](https://beanstalkd.github.io/).
Internally it uses [Pheanstalk](https://github.com/pheanstalk/pheanstalk) to interact with a Beanstalkd server.
It is solely designed for offloading work so that it can be processed elsewhere or at a later time.
This is especially useful for tasks that could take a long time, be hardware intensive, or otherwise negatively affect the application's performance.

```php
Centum\Queue\Queue(
    Centum\Interfaces\Container\ContainerInterface $container,
    Pheanstalk\Contract\PheanstalkInterface $pheanstalk
);
```

{: .highlight }
[`Centum\Queue\Queue`](https://github.com/SidRoberts/centum/blob/development/src/Queue/Queue.php) implements [`Centum\Interfaces\Queue\QueueInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Queue/QueueInterface.php).

[`Centum\Queue\Queue`](https://github.com/SidRoberts/centum/tree/development/src/Queue/Queue.php) features two public methods:

* `publish(Centum\Interfaces\Queue\TaskInterface $task): void`
* `consume(): Centum\Interfaces\Queue\TaskInterface`

Both methods work with [`Centum\Interfaces\Queue\TaskInterface`](https://github.com/SidRoberts/centum/tree/development/src/Interfaces/Queue/TaskInterface.php) which represents a piece of work that a background worker can execute.
Tasks are serialised and unserialised as they are transported through Beanstalkd so any complicated objects should be called through the Container in the `execute()` method:

```php
namespace App\Tasks;

use Centum\Container\Container;
use Centum\Interfaces\Queue\TaskInterface;

class LogTask implements TaskInterface
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
use Centum\Interfaces\Queue\QueueInterface;

class IndexController
{
    public function index(QueueInterface $queue): Response
    {
        $logTask = new LogTask("Queue works OK.");

        $queue->publish($logTask);

        return new Response("hello");
    }
}
```

```php
namespace App\Commands;

use Centum\Console\Command;
use Centum\Interfaces\Console\ParametersInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Queue\QueueInterface;

class QueueConsumeCommand extends Command
{
    public function getName(): string
    {
        return "queue-consume";
    }

    public function execute(TerminalInterface $terminal, ContainerInterface $container, ParametersInterface $parameters): int
    {
        $queue = $container->get(QueueInterface::class);

        $queue->consume();

        return 0;
    }
}
```

If a Task throws an Exception whilst it is being consumed, the Queue component will automatically bury it on Pheanstalk so that it can be dealt with later.

Queue used the `centum-tasks` tube to store Tasks (available from `Centum\Queue\Queue::TUBE`).
