---
layout: default
title: Access Actions
parent: Testing
permalink: testing/access
---



# Access Actions

[`Centum\Codeception\Actions\AccessActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/AccessActions.php)



## `grabAccess`

Grab the Access from the Container.

```php
grabAccess(): Centum\Interfaces\Access\AccessInterface
```



## `allowAccess`

Allow a user to do a particular activity in Access.

```php
allowAccess(
    string $user,
    string $activityName
): void
```



## `denyAccess`

Deny a user to do a particular activity in Access.

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

Check if a user is allowed to do a particular activity in Access.

```php
seeIsAllowed(
    string $user,
    string $activityName
): void
```



## `seeIsNotAllowed`

Check if a user is NOT allowed to do a particular activity in Access.

```php
seeIsNotAllowed(
    string $user,
    string $activityName
): void
```
