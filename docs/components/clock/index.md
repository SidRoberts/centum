---
layout: default
title: Clock
parent: Components
has_children: true
permalink: clock
---



# `Centum\Clock`

The Clock component provides a consistent way to determine the current time in your application.
It is especially useful for testing, scheduling, and anywhere you need to reference or control time.

{: .highlight }
Clocks implement [`Centum\Interfaces\Clock\ClockInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Clock/ClockInterface.php).

Clocks require two public methods:

- `public function now(): DateTimeImmutable`
- `public function sleep(int $seconds): void`
