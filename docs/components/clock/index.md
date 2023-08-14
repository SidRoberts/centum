---
layout: default
title: Clock
parent: Components
has_children: false
permalink: clock
---



# `Centum\Clock`

The Clock component handles time determination.

```php
Centum\Clock\Clock(
    string $datetime = "now",
    DateTimeZone|null $timezone = null
);
```

```php
use Centum\Clock\Clock;

$clock = new Clock();
```

{: .highlight }
[`Centum\Clock\Clock`](https://github.com/SidRoberts/centum/blob/development/src/Clock/Clock.php) implements [`Centum\Interfaces\Clock\ClockInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Clock/ClockInterface.php).

The `now()` method returns a `DateTimeImmutable` instance that can be used for when your code needs to reference the current time.

```php
$now = $clock->now();

$model->setDateUpdated($now);
```

This can be useful in testing that has timing-based side effects to ensure that tests are consistent and repeatable.
