---
layout: default
title: Beanstalkd Queue
parent: Queue
grand_parent: Components
permalink: queue/beanstalkd-queue
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
