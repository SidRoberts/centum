---
layout: default
title: Array Queue
parent: Queue Component
permalink: queue/array-queue
nav_order: 1
---



# Array Queue

[`Centum\Queue\ArrayQueue`](https://github.com/SidRoberts/centum/tree/development/src/Queue/ArrayQueue.php) is an in-memory queue implementation that is **not persistent**.
This makes it ideal for testing and development.



## Constructor

```php
Centum\Queue\ArrayQueue(
    Centum\Interfaces\Queue\TaskRunnerInterface $taskRunner
);
```



## Features

As this is designed for testing and development, it also providers the getters `getTasks()` and `getBuriedTasks()` so that you can inspect the contents of the queue.

If you call the `consume()` method when the Queue is empty, [`NoTasksInQueueException`](https://github.com/SidRoberts/centum/blob/main/src/Queue/Exception/NoTasksInQueueException.php) will be thrown.
This differs from [`BeanstalkdQueue`](beanstalkd-queue.md) which will wait until a Beanstalkd job is created.
