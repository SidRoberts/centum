---
layout: default
title: Array Queue
parent: Queue
grand_parent: Components
permalink: queue/array-queue
---



# Array Queue

The [`Centum\Queue\ArrayQueue`](https://github.com/SidRoberts/centum/tree/development/src/Queue/ArrayQueue.php) class stores Tasks in an array and are not persistent.

```php
Centum\Queue\ArrayQueue(
    Centum\Interfaces\Container\ContainerInterface $container
);
```

As this is designed for testing and development, it also providers the getters `getTasks()` and `getBuriedTasks()` so that you can inspect the contents of the queue.

If you call the `consume()` method when the Queue is empty, [`NoTasksInQueueException`](https://github.com/SidRoberts/centum/blob/development/src/Queue/Exception/NoTasksInQueueException.php) will be thrown.
This differs from [`BeanstalkdQueue`](beanstalkd-queue.md) which will wait until a Beanstalkd job is created.
