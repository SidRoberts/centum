---
layout: default
title: Queue Component
has_children: true
permalink: queue
---



# `Centum\Queue`

The Queue component enables you to offload work for asynchronous or deferred processing.
This is especially useful for tasks that are time-consuming, resource-intensive, or could negatively impact application performance if run synchronously.



## Interface Overview

[`Centum\Interfaces\Queue\QueueInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Queue/QueueInterface.php) exposes two main methods:

- `publish(Centum\Interfaces\Queue\TaskInterface $task): void`
  Add a task to the queue for later execution.
- `consume(): Centum\Interfaces\Queue\TaskInterface`
  Retrieve and execute the next available task.

When `consume()` is called, the next task is executed.
If a task throws an exception during execution, the queue implementation **may** bury or mark it as failed for later inspection or retry.



## Task Representation

All queue operations use [`Centum\Interfaces\Queue\TaskInterface`](https://github.com/SidRoberts/centum/tree/development/src/Interfaces/Queue/TaskInterface.php), which represents a unit of work for a background worker.
Tasks may be serialized/unserialized internally, so complex dependencies should be resolved via the Container in the `execute()` method.

### Example Task

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



## Typical Usage

Tasks can be published from anywhere in your application and consumed elsewhere, such as in a background worker or CLI command.

### Publishing a Task (e.g., from a Controller)

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

### Consuming Tasks (e.g., from a Console Command)

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

        return self::SUCCESS;
    }
}
```



## Supported Queue Implementations

- [ArrayQueue](array-queue.md): In-memory, non-persistent queue for testing and development.
- [BeanstalkdQueue](beanstalkd-queue.md): Persistent queue backed by Beanstalkd.
- [ImmediateQueue](immediate-queue.md): Executes tasks synchronously as soon as they are published.



## Links

- [Source code (`src/Queue/`)](https://github.com/SidRoberts/centum/blob/main/src/Queue/)
- [Interfaces (`src/Interfaces/Queue/`)](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Queue/)
- [Unit tests (`tests/Unit/Queue/`)](https://github.com/SidRoberts/centum/blob/main/tests/Unit/Queue/)
