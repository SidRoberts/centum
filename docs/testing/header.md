---
layout: default
title: Header Actions
parent: Testing
permalink: testing/header
---



# Header Actions

[`Centum\Codeception\Actions\HeaderActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/HeaderActions.php)



## `grabHeaders`

```php
grabHeaders(): Centum\Interfaces\Http\HeadersInterface
```



## `grabHeaderValue`

```php
grabHeaderValue(
    string $name
): ?string
```



## `seeHeader`

```php
seeHeader(
    string $name
): void
```



## `dontSeeHeader`

```php
dontSeeHeader(
    string $name
): void
```



## `seeHeaderValueIs`

```php
seeHeaderValueIs(
    string $name,
    string $expectedValue
): void
```



## `dontSeeHeaderValueIs`

```php
dontSeeHeaderValueIs(
    string $name,
    string $expectedValue
): void
```
