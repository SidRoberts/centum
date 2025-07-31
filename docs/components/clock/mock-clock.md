---
layout: default
title: Mock Clock
parent: Clock
permalink: clock/mock-clock
nav_order: 2
---



# `Centum\Clock\MockClock`

`MockClock` is designed for testing scenarios where you need to control or freeze the current time.
It allows you to specify a fixed time and timezone, ensuring your tests are consistent and repeatable.



## Constructor

```php
Centum\Clock\MockClock(
    string $datetime = "now",
    ?DateTimeZone $timeZone = null
);
```

- `$datetime`: The starting point for the clock (default is `"now"`).
- `$timeZone`: The timezone for the clock (default is system timezone).



## Usage

Create a new clock instance:

```php
use Centum\Clock\MockClock;

$clock = new MockClock();
```

You can specify a fixed time and timezone for testing:

```php
use Centum\Clock\Clock;
use DateTimeZone;

$clock = new MockClock(
    "2024-01-01 12:00:00",
    new DateTimeZone("UTC")
);
```



## Getting the Current Time

The `now()` method returns a `DateTimeImmutable` instance representing the Mock Clock's current time:

```php
$now = $clock->now();

$model->setDateUpdated($now);
```


## Stopping and Starting Time

By default the clock is "stopped" — it will return the same time unless you modify it.

Use the `start()` and `stop()` methods to allow time to progress at it's natural pace.

In this example, the clock will advance approximately 5 seconds:

```php
$clock->start();

sleep(5);

$clock->stop();
```



## Benefits for Testing

By injecting a clock with a fixed time, you can ensure your tests are consistent and repeatable, avoiding flaky tests caused by real-time changes.

```php
$clock = new MockClock("2024-01-01 00:00:00");

$model->setLastUpdated(
    $clock->now() // Always returns the same value
);
```
