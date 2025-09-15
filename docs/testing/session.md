---
layout: default
title: Session Actions
parent: Testing
permalink: testing/session
---



# Session Actions

[`Centum\Codeception\Actions\SessionActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/SessionActions.php)



## `grabSession`

Grab the HTTP Session from the Container.

```php
grabSession(): Centum\Interfaces\Http\SessionInterface
```



## `seeInSession`

Check that a Session key exists.

```php
seeInSession(
    non-empty-string $key
): void
```



## `dontSeeInSession`

Check that a Session key does not exist.

```php
dontSeeInSession(
    non-empty-string $key
): void
```



## `grabFromSession`

```php
grabFromSession(
    non-empty-string $key,
    mixed $defaultValue = null
): mixed
```



## `seeValueInSessionIs`

```php
seeValueInSessionIs(
    non-empty-string $key,
    mixed $expectedValue
): void
```



## `seeValueInSessionIsNot`

```php
seeValueInSessionIsNot(
    non-empty-string $key,
    mixed $expectedValue
): void
```



## `removeFromSession`

Remove a key from the Session.

```php
removeFromSession(
    non-empty-string $key
): void
```
