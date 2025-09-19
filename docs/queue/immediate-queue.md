---
layout: default
title: Immediate Queue
parent: Queue Component
permalink: queue/immediate-queue
nav_order: 3
---



# Immediate Queue

[`Centum\Queue\ImmediateQueue`](https://github.com/SidRoberts/centum/tree/development/src/Queue/ImmediateQueue.php) immediately executes any tasks published to it.

{: .callout.info }
This is technically not a queue as Tasks are executed synchronously within the `publish()` method.



## Constructor

```php
Centum\Queue\ImmediateQueue(
    Centum\Interfaces\Queue\TaskRunnerInterface $taskRunner
);
```



## Features

Tasks are run instantly when `publish()` is called.

As this is designed for testing and development, it also providers the getter `getBuriedTasks()` so that you can inspect the contents of the queue.

As no Tasks are stored in the Queue, calling the `consume()` method will throw [`NoTasksInQueueException`](https://github.com/SidRoberts/centum/blob/main/src/Queue/Exception/NoTasksInQueueException.php).
