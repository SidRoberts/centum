---
layout: default
title: Interfaces
parent: Access
grand_parent: Components
permalink: access/interfaces
nav_order: 102
---



# Interfaces

(all in the `Centum\Interfaces\Access` namespace)



## [`Centum\Interfaces\Access\AccessInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Access/AccessInterface.php)

- `allow(string $user, string $activityName): void`
- `deny(string $user, string $activityName): void`
- `remove(string $user, string $activityName): void`
- `isAllowed(string $user, string $activityName): bool`



## [`Centum\Interfaces\Access\ActivityInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Access/ActivityInterface.php)

- `getName(): string`
- `allow(string $user): void`
- `deny(string $user): void`
- `remove(string $user): void`
- `isAllowed(string $user): bool`
