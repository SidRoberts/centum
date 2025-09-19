---
layout: default
title: Interfaces
parent: Cron Component
permalink: cron/interfaces
nav_order: 102
---



# Interfaces

(all in the `Centum\Interfaces\Cron` namespace)



## [`CronInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Cron/CronInterface.php)

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



## [`JobInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Cron/JobInterface.php)

```php
getExpression(): non-empty-string
```

```php
getData(): mixed
```
