---
layout: default
title: Access Actions
parent: Testing
permalink: testing/access
---



# Access Actions

[`Centum\Codeception\Actions\AccessActions`](https://github.com/SidRoberts/centum/blob/main/src/Codeception/Actions/AccessActions.php)



## `grabAccess`

Grab the Access from the Container.

```php
grabAccess(): Centum\Interfaces\Access\AccessInterface
```



## `allowAccess`

Allow a user to do a particular activity in Access.

```php
allowAccess(
    non-empty-string $user,
    non-empty-string $activityName
): void
```



## `denyAccess`

Deny a user to do a particular activity in Access.

```php
denyAccess(
    non-empty-string $user,
    non-empty-string $activityName
): void
```



## `removeFromAccess`

Remove a rule from Access.

```php
removeFromAccess(
    non-empty-string $user,
    non-empty-string $activityName
): void
```



## `seeIsAllowed`

Check if a user is allowed to do a particular activity in Access.

```php
seeIsAllowed(
    non-empty-string $user,
    non-empty-string $activityName
): void
```



## `seeIsNotAllowed`

Check if a user is NOT allowed to do a particular activity in Access.

```php
seeIsNotAllowed(
    non-empty-string $user,
    non-empty-string $activityName
): void
```
