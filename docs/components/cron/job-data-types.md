---
layout: default
title: Job data types
parent: Cron
grand_parent: Components
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
