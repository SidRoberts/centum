---
layout: default
title: Filter Actions
parent: Testing
permalink: testing/filter
---



# Filter Actions

[`Centum\Codeception\Actions\FilterActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/FilterActions.php)



## `expectFilterOutput`

```php
expectFilterOutput(
    Centum\Interfaces\Filter\FilterInterface $filter,
    mixed $input,
    mixed $output
): void
```



## `expectFilterThrowable`

```php
expectFilterThrowable(
    Throwable $expectedThrowable,
    Centum\Interfaces\Filter\FilterInterface $filter,
    mixed $input
): void
```
