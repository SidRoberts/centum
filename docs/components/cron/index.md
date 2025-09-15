---
layout: default
title: Cron
parent: Components
has_children: true
permalink: cron
---



# `Centum\Cron`

This component is designed for development workflows that would benefit from having scheduled tasks defined in PHP or at least in the same codebase as the rest of the code.

Cron Jobs are represented by [`Centum\Cron\Job`](https://github.com/SidRoberts/centum/blob/main/src/Cron/Job.php).
Jobs take two parameters, the Cron expression and the job data which can take any form:

```php
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

$job3 = new Job(
    "0 9 * * 1-5",
    function (): void {
        // Do something...
    }
);
```

Cron Jobs can be added to a [`Centum\Cron\Cron`](https://github.com/SidRoberts/centum/blob/main/src/Cron/Cron.php) object that determines which jobs are due at any given time.

{: .highlight }
[`Centum\Cron\Cron`](https://github.com/SidRoberts/centum/blob/main/src/Cron/Cron.php) implements [`Centum\Interfaces\Cron\CronInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Cron/CronInterface.php).

```php
use Centum\Cron\Cron;

$cron = new Cron();

$cron->add($job1);
$cron->add($job2);
$cron->add($job3);

$dueJobs = $cron->getDueJobs();

foreach ($dueJobs as $job) {
    $data = $job->getData();

    // Do something...
}
```
