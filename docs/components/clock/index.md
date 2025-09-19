---
layout: default
title: Clock Component
has_children: true
permalink: clock
---



# `Centum\Clock`

The Clock component provides a consistent way to determine the current time in your application.
It is especially useful for testing, scheduling, and anywhere you need to reference or control time.

{: .callout.info }
Clocks implement [`Centum\Interfaces\Clock\ClockInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Clock/ClockInterface.php).

Clocks require two public methods:

- `now(): DateTimeImmutable`
- `sleep(int $seconds): void`



## Available Implementations

- [`Centum\Clock\SystemClock`](https://github.com/SidRoberts/centum/blob/main/src/Clock/SystemClock.php):
  Useful for production.
- [`Centum\Clock\MockClock`](https://github.com/SidRoberts/centum/blob/main/src/Clock/MockClock.php):
  Useful for testing.



## Links

- [Source code (`src/Clock/`)](https://github.com/SidRoberts/centum/blob/main/src/Clock/)
- [Interfaces (`src/Interfaces/Clock/`)](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Clock/)
- [Unit tests (`tests/Unit/Clock/`)](https://github.com/SidRoberts/centum/blob/main/tests/Unit/Clock/)
