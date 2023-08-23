---
layout: default
title: Session Actions
parent: Testing
permalink: testing/session
---



# Session Actions

[`Centum\Codeception\Actions\SessionActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/SessionActions.php)



## `grabSession`

```php
grabSession(): Centum\Interfaces\Http\SessionInterface
```



## `seeInSession`

```php
seeInSession(
    string $key
): void
```



## `dontSeeInSession`

```php
dontSeeInSession(
    string $key
): void
```



## `grabFromSession`

```php
grabFromSession(
    string $key,
    mixed $defaultValue = null
): mixed
```



## `seeValueInSessionIs`

```php
seeValueInSessionIs(
    string $key,
    mixed $expectedValue
): void
```



## `seeValueInSessionIsNot`

```php
seeValueInSessionIsNot(
    string $key,
    mixed $expectedValue
): void
```



## `removeFromSession`

```php
removeFromSession(
    string $key
): void
```
