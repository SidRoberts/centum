---
layout: default
title: Immediate Queue
parent: Queue
grand_parent: Components
permalink: queue/immediate-queue
nav_order: 3
---



# Immediate Queue

The [`Centum\Queue\ImmediateQueue`](https://github.com/SidRoberts/centum/tree/development/src/Queue/ImmediateQueue.php) class immediately executes any Tasks that are published to it.
This technically is not a Queue as Tasks are actually executed within the `publish()` method.

```php
Centum\Queue\ImmediateQueue(
    Centum\Interfaces\Queue\TaskRunnerInterface $taskRunner
);
```

As this is designed for testing and development, it also providers the getter `getBuriedTasks()` so that you can inspect the contents of the queue.

As no Tasks are stored in the Queue, calling the `consume()` method will throw [`NoTasksInQueueException`](https://github.com/SidRoberts/centum/blob/development/src/Queue/Exception/NoTasksInQueueException.php).
