---
layout: default
title: Setting custom times
parent: Cron
---



Running `getDueJobs()` without a parameter assumes the current time.
By specifying a `DateTime` object, you can see the due jobs at a given point in time:

```php
$midnight = new \DateTime("2019-03-21 00:00:00");

$jobsDueAtMidnight = $cron->getDueJobs(
    $midnight
);
```
