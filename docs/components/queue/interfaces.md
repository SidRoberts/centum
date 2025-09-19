---
layout: default
title: Interfaces
parent: Queue Component
permalink: queue/interfaces
nav_order: 102
---



# Interfaces

(all in the `Centum\Interfaces\Queue` namespace)



## [`QueueInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Queue/QueueInterface.php)

```php
publish(
    Centum\Interfaces\Queue\TaskInterface $task
): void
```

```php
consume(): Centum\Interfaces\Queue\TaskInterface
```



## [`TaskInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Queue/TaskInterface.php)

```php
execute(
    Centum\Interfaces\Container\ContainerInterface $container
): void
```



## [`TaskRunnerInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Queue/TaskRunnerInterface.php)

```php
execute(
    Centum\Interfaces\Queue\TaskInterface $task
): void
```
