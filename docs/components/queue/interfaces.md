---
layout: default
title: Interfaces
parent: Queue
grand_parent: Components
permalink: queue/interfaces
nav_order: 102
---



# Interfaces

(all in the `Centum\Interfaces\Queue` namespace)



## [`Centum\Interfaces\Queue\QueueInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Queue/QueueInterface.php)

```php
publish(
    Centum\Interfaces\Queue\TaskInterface $task
): void
```

```php
consume(): Centum\Interfaces\Queue\TaskInterface
```



## [`Centum\Interfaces\Queue\TaskInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Queue/TaskInterface.php)

```php
execute(
    Centum\Interfaces\Container\ContainerInterface $container
): void
```



## [`Centum\Interfaces\Queue\TaskRunnerInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Queue/TaskRunnerInterface.php)

```php
execute(
    Centum\Interfaces\Queue\TaskInterface $task
): void
```
