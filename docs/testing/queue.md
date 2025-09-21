---
layout: default
title: Queue Actions
parent: Testing
permalink: testing/queue
---



# Queue Actions

[`Centum\Codeception\Actions\QueueActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/QueueActions.php)



## `grabQueue`

Grab the Queue from the Container.

```php
grabQueue(): Centum\Interfaces\Queue\QueueInterface
```



## `grabTaskRunner`

Grab the Task Runner from the Container.

```php
grabTaskRunner(): Centum\Interfaces\Queue\TaskRunnerInterface
```



## `useArrayQueue`

```php
useArrayQueue(): void
```



## `useImmediateQueue`

```php
useImmediateQueue(): void
```



## `publishToQueue`

Publish a Task to the Queue.

```php
publishToQueue(
    Centum\Interfaces\Queue\TaskInterface $task
): void
```



## `consumeFromQueue`

Consume a Task from the Queue.

```php
consumeFromQueue(): Centum\Interfaces\Queue\TaskInterface
```



## `grabQueueTasks`

```php
grabQueueTasks(): list<Centum\Interfaces\Queue\TaskInterface>
```



## `grabQueueBuriedTasks`

```php
grabQueueBuriedTasks(): list<Centum\Interfaces\Queue\TaskInterface>
```



## `executeTask`

Executes a Task using the Task Runner.

```php
executeTask(
    Centum\Interfaces\Queue\TaskInterface $task
): void
```
