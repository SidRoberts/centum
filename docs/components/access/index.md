---
layout: default
title: Access
parent: Components
has_children: true
permalink: access
---



# `Centum\Access`

## Purpose

This component simplifies access control management.

Users (or groups of users) can allowed or denied the privilege of an activity.
Activities are known by a single string identifier, as are users/groups, to keep things simple.

```php
Centum\Access\Access(
    bool $default = Centum\Access\Access::ALLOW
);
```

{: .highlight }
[`Centum\Access\Access`](https://github.com/SidRoberts/centum/blob/development/src/Access/Access.php) implements [`Centum\Interfaces\Access\AccessInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Access/AccessInterface.php).

[`Centum\Access\Access`](https://github.com/SidRoberts/centum/blob/development/src/Access/Access.php) has 2 public constants:

- `Centum\Access\Access::ALLOW`
- `Centum\Access\Access::DENY`

[`Centum\Access\Access`](https://github.com/SidRoberts/centum/blob/development/src/Access/Access.php) has 5 public methods:

- `public function getName(): string`
- `public function allow(string $user, string $activityName): void`
- `public function deny(string $user, string $activityName): void`
- `public function remove(string $user, string $activityName): void`
- `public function isAllowed(string $user, string $activityName): bool`



## Whitelists and Blacklists

The Access component can be used as a whitelist or blacklist by setting the default value with the `ALLOW` or `DENY` constants.
By default, `Access` uses `ALLOW`, meaning that it will act as a whitelist.

### Whitelist

A whitelist means that users are allowed to do anything unless explicitly stated otherwise.

```php
use Centum\Access\Access;

$access = new Access(
    Access::ALLOW
);
```

### Blacklist

A blacklist means that users are not allowed to do anything unless explicitly stated otherwise.

```php
use Centum\Access\Access;

$access = new Access(
    Access::DENY
);
```



## Setting Rules

Rules can be set using the `allow()` and `deny()` methods:

```php
$access->allow("admin", "delete-a-user");
```

```php
$access->deny("moderator", "delete-a-user");
```

You can then check what a user is able to do with `isAllowed()`:

```php
use Exception;

$userType = "moderator";

if (!$access->isAllowed($userType, "delete-a-user")) {
    throw new Exception("Access denied.");
}

$user->delete();
```

Even simpler, you can use `verify()` which will throw an `AccessDeniedException` if the user is not allowed to do a certain action.

```php
$userType = "moderator";

$access->verify($userType, "delete-a-user");

$user->delete();
```
