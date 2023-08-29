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

```php
add(
    Centum\Interfaces\Cron\JobInterface $job
): void
```

```php
getDueJobs(
    DateTimeInterface $datetime = null
): array<Centum\Interfaces\Cron\JobInterface>
```

```php
getAllJobs(): array<Centum\Interfaces\Cron\JobInterface>
```



## [`Centum\Interfaces\Cron\JobInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Cron/JobInterface.php)

```php
getExpression(): string
```

```php
getData(): mixed
```
