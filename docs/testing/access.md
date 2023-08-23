---
layout: default
title: Access Actions
parent: Testing
permalink: testing/access
---



# Access Actions

[`Centum\Codeception\Actions\AccessActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/AccessActions.php)



## `grabAccess`

```php
grabAccess(): Centum\Interfaces\Access\AccessInterface
```



## `allowAccess`

```php
allowAccess(
    string $user,
    string $activityName
): void
```



## `denyAccess`

```php
denyAccess(
    string $user,
    string $activityName
): void
```



## `removeFromAccess`

```php
removeFromAccess(
    string $user,
    string $activityName
): void
```



## `seeIsAllowed`

```php
seeIsAllowed(
    string $user,
    string $activityName
): void
```



## `seeIsNotAllowed`

```php
seeIsNotAllowed(
    string $user,
    string $activityName
): void
```
