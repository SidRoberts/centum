---
layout: default
title: System Clock
parent: Clock Component
permalink: clock/system-clock
nav_order: 1
---



# `Centum\Clock\SystemClock`

`SystemClock` provides the current system time, optionally in a specified timezone.
It always returns the actual current time, making it suitable for production use.



## Constructor

```php
Centum\Clock\SystemClock(
    ?DateTimeZone $timeZone = null
);
```

- `$timeZone`: The time zone for the clock (default is system timezone).



## Usage

Create a new system clock instance:

```php
use Centum\Clock\SystemClock;

$clock = new SystemClock();
```

You can optionally specify a timezone:

```php
use Centum\Clock\SystemClock;
use DateTimeZone;

$clock = new SystemClock(
    new DateTimeZone("UTC")
);
```



## Sleeping

The `sleep()` method internally calls the `sleep()` function, so it will delay the program execution by the given number of seconds.

```php
$clock->sleep(5);
```



## Getting the Current Time

The `now()` method returns a `DateTimeImmutable` instance representing the current system time:

```php
$now = $clock->now();

$model->setDateUpdated($now);
```
