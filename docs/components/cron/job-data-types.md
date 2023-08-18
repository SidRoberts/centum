---
layout: default
title: Job data types
parent: Cron
grand_parent: Components
permalink: cron/job-data-types
nav_order: 1
---



# Job data types

By design, Cron Job objects can hold any kind of data - strings, arrays, functions, etc;.
You could even mix and match several data types together.

For example, you could store shell commands and run them with `shell_exec()`:

```php
use Centum\Cron\Job;

$job = new Job(
    "* * * * *",
    "sh do-something.sh"
);

// ...

$dueJobs = $cron->getDueJobs();

foreach ($dueJobs as $job) {
    $data = $job->getData();

    shell_exec($data);
}
```

You could wrap your code in a function and execute them when they are due:

```php
use Centum\Cron\Job;

$job = new Job(
    "* * * * *",
    function () {
        // ...
    }
);

// ...

$dueJobs = $cron->getDueJobs();

foreach ($dueJobs as $job) {
    $data = $job->getData();

    call_user_func($data);
}
```

To enforce a particular type, you can extend `Centum\Cron\Job`.
For example, you can use this class to enforce that all jobs use a [`Centum\Interfaces\Queue\TaskInterface` object](../queue/index.md):

```php
namespace App;

use Centum\Cron\Job;
use Centum\Interfaces\Queue\TaskInterface;

class TaskJob extends Job
{
    public function __construct(string $expression, TaskInterface $data)
    {
        parent::__construct($expression, $data);
    }

    public function getData(): TaskInterface
    {
        return $this->data;
    }
}
```
