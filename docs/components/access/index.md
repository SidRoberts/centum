---
layout: default
title: Access
parent: Components
has_children: true
permalink: access
---



# `Centum\Access`

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
