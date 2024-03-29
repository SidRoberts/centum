---
layout: default
title: Queue
parent: Components
has_children: true
permalink: queue
---



# `Centum\Queue`

The Queue component is designed for offloading work so that it can be processed elsewhere or at a later time.
This is especially useful for tasks that could take a long time, be hardware intensive, or otherwise negatively affect the application's performance.

[`Centum\Interfaces\Queue\QueueInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Queue/QueueInterface.php) features two public methods:

* `publish(Centum\Interfaces\Queue\TaskInterface $task): void`
* `consume(): Centum\Interfaces\Queue\TaskInterface`

The `consume()` method will retreive the next available Task and also execute it.
If a Task throws an Exception whilst it is being consumed, the Queue component **may** bury it or mark it as failed so that it can be dealt with later.

Both methods work with [`Centum\Interfaces\Queue\TaskInterface`](https://github.com/SidRoberts/centum/tree/development/src/Interfaces/Queue/TaskInterface.php) which represents a piece of work that a background worker can execute.
Tasks may be serialised/unserialised internally so any complicated objects should be called through the Container in the `execute()` method:

```php
namespace App\Tasks;

use Centum\Interfaces\Container\ContainerInterface;
use Centum\Interfaces\Queue\TaskInterface;

class LogTask implements TaskInterface
{
    public function __construct(
        protected readonly string $message
    ) {
    }

    public function execute(ContainerInterface $container): void
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

This Task can then be published from anywhere and consumed from anywhere else in your code.
One typical use case is publishing a Task from within a Controller and then consuming it in a Command:

```php
namespace App\Web\Controllers;

use App\Tasks\LogTask;
use Centum\Http\Response;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Queue\QueueInterface;
use Centum\Interfaces\Router\ControllerInterface;

class IndexController implements ControllerInterface
{
    public function index(QueueInterface $queue): ResponseInterface
    {
        $logTask = new LogTask("Queue works OK.");

        $queue->publish($logTask);

        return new Response("hello");
    }
}
```

```php
namespace App\Console\Commands;

use Centum\Console\CommandMetadata;
use Centum\Interfaces\Console\CommandInterface;
use Centum\Interfaces\Console\TerminalInterface;
use Centum\Interfaces\Queue\QueueInterface;

#[CommandMetadata("queue:consume")]
class QueueConsumeCommand implements CommandInterface
{
    public function __construct(
        protected readonly QueueInterface $queue
    ) {
    }

    public function execute(TerminalInterface $terminal): int
    {
        $this->queue->consume();

        return 0;
    }
}
```
