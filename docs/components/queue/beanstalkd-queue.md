---
layout: default
title: Beanstalkd Queue
parent: Queue
grand_parent: Components
permalink: queue/beanstalkd-queue
nav_order: 2
---



# Beanstalkd Queue

[`Centum\Queue\BeanstalkdQueue`](https://github.com/SidRoberts/centum/tree/development/src/Queue/BeanstalkdQueue.php) provides a simple, focused frontend for [Beanstalkd](https://beanstalkd.github.io/), a fast and lightweight queue service.
Internally, it uses [Pheanstalk](https://github.com/pheanstalk/pheanstalk) to communicate with a Beanstalkd server.



## Constructor

```php
Centum\Queue\BeanstalkdQueue(
    Centum\Interfaces\Queue\TaskRunnerInterface $taskRunner,
    Pheanstalk\Contract\PheanstalkPublisherInterface $pheanstalkPublisher,
    Pheanstalk\Contract\PheanstalkSubscriberInterface $pheanstalkSubscriber
);
```



## Tube

It uses the `centum-tasks` tube to store Tasks (accessible via `Centum\Queue\BeanstalkdQueue::TUBE`).



## Task Lifecycle

Tasks have **10 minutes** to complete before Beanstalkd will release them and allow them to be run again.
