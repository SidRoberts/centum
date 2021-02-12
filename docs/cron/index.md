---
layout: default
title: Cron
has_children: true
permalink: cron
---



# `Centum\Cron`

This component is designed for development workflows that would benefit from having scheduled tasks defined in PHP or at least in the same codebase as the rest of the code.

Cron Jobs are handled by [`Centum\Cron\Cron`](https://github.com/SidRoberts/centum/blob/development/src/Cron/Cron.php) and it determines which jobs are due at any given time.

```php
use Centum\Cron\Cron;
use Centum\Cron\Job;

$job1 = new Job(
    "* * * * *",
    [
        "task",
        "action",
        "params",
    ]
);

$job2 = new Job(
    "@daily",
    "echo 'hello world'"
);



$cron = new Cron();

$cron->add($job1);
$cron->add($job2);



$dueJobs = $cron->getDueJobs();

foreach ($dueJobs as $job) {
    $data = $job->getData();

    // Do something...
}
```
