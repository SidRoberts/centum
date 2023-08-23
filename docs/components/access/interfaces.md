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

```php
allow(
    string $user,
    string $activityName
): void
```

```php
deny(
    string $user,
    string $activityName
): void
```

```php
remove(
    string $user,
    string $activityName
): void
```

```php
isAllowed(
    string $user,
    string $activityName
): bool
```



## [`Centum\Interfaces\Access\ActivityInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Access/ActivityInterface.php)

```php
getName(): string
```

```php
allow(
    string $user
): void
```

```php
deny(
    string $user
): void
```

```php
remove(
    string $user
): void
```

```php
isAllowed(
    string $user
): bool
```
