---
layout: default
title: Queue Actions
parent: Testing
permalink: testing/queue
---



# Queue Actions

[`Centum\Codeception\Actions\QueueActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/QueueActions.php)



## `grabQueue`

Grab the Queue from the Container.

```php
grabQueue(): Centum\Interfaces\Queue\QueueInterface
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

```php
publishToQueue(
    Centum\Interfaces\Queue\TaskInterface $task
): void
```



## `consumeFromQueue`

```php
consumeFromQueue(): Centum\Interfaces\Queue\TaskInterface
```



## `grabQueueTasks`

```php
grabQueueTasks(): array<Centum\Interfaces\Queue\TaskInterface>
```



## `grabQueueBuriedTasks`

```php
grabQueueBuriedTasks(): array<Centum\Interfaces\Queue\TaskInterface>
```



## `executeTask`

```php
executeTask(
    Centum\Interfaces\Queue\TaskInterface $task
): void
```
