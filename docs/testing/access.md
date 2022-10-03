---
layout: default
title: Access Actions
parent: Testing
permalink: testing/access
---



# Access Actions

[`Centum\Codeception\Actions\AccessActions`](https://github.com/SidRoberts/centum/blob/development/src/Codeception/Actions/AccessActions.php)

- `grabAccess(): Centum\Interfaces\Access\AccessInterface`
- `allowAccess(string $user, string $activityName): void`
- `denyAccess(string $user, string $activityName): void`
- `removeFromAccess(string $user, string $activityName): void`
- `seeIsAllowed(string $user, string $activityName): void`
- `seeIsNotAllowed(string $user, string $activityName): void`
