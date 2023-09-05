---
layout: default
title: Header Actions
parent: Testing
permalink: testing/header
---



# Header Actions

[`Centum\Codeception\Actions\HeaderActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/HeaderActions.php)



## `grabHeaders`

Grab the HTTP Headers from the Container.

```php
grabHeaders(): Centum\Interfaces\Http\HeadersInterface
```



## `grabHeaderValue`

```php
grabHeaderValue(
    non-empty-string $name
): ?string
```



## `seeHeader`

Check that a Header exists.

```php
seeHeader(
    non-empty-string $name
): void
```



## `dontSeeHeader`

Check that a Header does not exist.

```php
dontSeeHeader(
    non-empty-string $name
): void
```



## `seeHeaderValueIs`

```php
seeHeaderValueIs(
    non-empty-string $name,
    string $expectedValue
): void
```



## `dontSeeHeaderValueIs`

```php
dontSeeHeaderValueIs(
    non-empty-string $name,
    string $expectedValue
): void
```
