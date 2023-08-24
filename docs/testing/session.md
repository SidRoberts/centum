---
layout: default
title: Session Actions
parent: Testing
permalink: testing/session
---



# Session Actions

[`Centum\Codeception\Actions\SessionActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/SessionActions.php)



## `grabSession`

Grab the HTTP Session from the Container.

```php
grabSession(): Centum\Interfaces\Http\SessionInterface
```



## `seeInSession`

Check that a Session key exists.

```php
seeInSession(
    string $key
): void
```



## `dontSeeInSession`

Check that a Session key does not exist.

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

Remove a key from the Session.

```php
removeFromSession(
    string $key
): void
```
