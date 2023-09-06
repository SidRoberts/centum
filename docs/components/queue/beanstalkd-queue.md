---
layout: default
title: Beanstalkd Queue
parent: Queue
grand_parent: Components
permalink: queue/beanstalkd-queue
nav_order: 2
---



# Beanstalkd Queue

[`Centum\Queue\BeanstalkdQueue`](https://github.com/SidRoberts/centum/tree/development/src/Queue/BeanstalkdQueue.php) acts as a very simple and focussed frontend for [Beanstalkd](https://beanstalkd.github.io/).
Internally it uses [Pheanstalk](https://github.com/pheanstalk/pheanstalk) to interact with a Beanstalkd server.

```php
Centum\Queue\BeanstalkdQueue(
    Centum\Interfaces\Queue\TaskRunnerInterface $taskRunner,
    Pheanstalk\Contract\PheanstalkInterface $pheanstalk
);
```

It uses the `centum-tasks` tube to store Tasks (available from `Centum\Queue\BeanstalkdQueue::TUBE`).

Tasks have 10 minutes to complete before Beanstalkd will release them and allow them to be run again.
