---
layout: default
title: Usage
parent: Cron
---



Cron Jobs are handled by [`Centum\Cron\Cron`](https://github.com/SidRoberts/centum/blob/development/src/Cron/Cron.php) and it determines which jobs are due at any given time.

```php
$job1 = new \Centum\Cron\Job(
    "* * * * *",
    [
        "task",
        "action",
        "params",
    ]
);

$job2 = new \Centum\Cron\Job(
    "@daily",
    "echo 'hello world'"
);



$cron = new \Centum\Cron\Cron();

$cron->add($job1);
$cron->add($job2);



$dueJobs = $cron->getDueJobs();

foreach ($dueJobs as $job) {
    $data = $job->getData();

    // Do something...
}
```
