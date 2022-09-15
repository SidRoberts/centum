---
layout: default
title: Setting custom times
parent: Cron
grand_parent: Components
permalink: cron/setting-custom-times
---



# Setting custom times

Running `getDueJobs()` without a parameter assumes the current time.
By specifying a `DateTimeInterface` object, you can see the due jobs at a given point in time:

```php
use DateTime;

$midnight = new DateTime("2019-03-21 00:00:00");

$jobsDueAtMidnight = $cron->getDueJobs($midnight);
```
