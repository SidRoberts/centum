---
layout: default
title: Building from an array
parent: Cron Component
permalink: cron/building-from-an-array
nav_order: 2
---



# Building from an array

It is possible to build a Cron manager from an array using the [Factory class](https://github.com/SidRoberts/centum/blob/main/src/Cron/Factory.php):

```php
use Centum\Cron\CronFactory;

$cronFactory = new CronFactory();

$cron = $cronFactory->createFromArray(
    [
        [
            "* * * * *",
            "sh do-something.sh",
        ],

        [
            "@weekly",
            "sh purge-cache.sh",
        ],

        [
            "@daily",
            "sh backup.sh",
        ],
    ]
);

$dueJobs = $cron->getDueJobs();
```

This could be useful if you wanted to store your cron jobs in a non-PHP config file.
