---
layout: default
title: Unit Tests Actions
parent: Testing
permalink: testing/unit-tests
---



# Unit Tests Actions

[`Centum\Codeception\Actions\UnitTestActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/UnitTestActions.php)



## `grabEchoContent`

```php
grabEchoContent(
    callable $callable
): string
```



## `expectEcho`

```php
expectEcho(
    string $expected,
    callable $callable
): void
```



## `getPropertyValue`

```php
getPropertyValue(
    object $object,
    non-empty-string $name
): mixed
```
