---
layout: default
title: Unit Test Actions
parent: Testing
permalink: testing/unit-test
---



# Unit Test Actions

[`Centum\Codeception\Actions\UnitTestActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/UnitTestActions.php)



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
