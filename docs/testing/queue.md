---
layout: default
title: Queue Actions
parent: Testing
permalink: testing/queue
---



# Queue Actions

[`Centum\Codeception\Actions\QueueActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/QueueActions.php)

- `grabQueue(): Centum\Interfaces\Queue\QueueInterface`
- `useArrayQueue(): void`
- `useImmediateQueue(): void`
- `publishToQueue(Centum\Interfaces\Queue\TaskInterface $task): void`
- `consumeFromQueue(): Centum\Interfaces\Queue\TaskInterface`
- `grabQueueTasks(): array<Centum\Interfaces\Queue\TaskInterface>`
- `grabQueueBuriedTasks(): array<Centum\Interfaces\Queue\TaskInterface>`
- `executeTask(Centum\Interfaces\Queue\TaskInterface $task): void`
