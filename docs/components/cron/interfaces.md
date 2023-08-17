---
layout: default
title: Interfaces
parent: Cron
grand_parent: Components
permalink: cron/interfaces
nav_order: 102
---



# Interfaces

(all in the `Centum\Interfaces\Cron` namespace)



## [`Centum\Interfaces\Cron\CronInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Cron/CronInterface.php)

- `add(Centum\Interfaces\Cron\JobInterface $job): void`
- `getDueJobs(DateTimeInterface $datetime = null): array`
- `getAllJobs(): array`



## [`Centum\Interfaces\Cron\JobInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Cron/JobInterface.php)

- `isDue(DateTimeInterface $datetime = null): bool`
