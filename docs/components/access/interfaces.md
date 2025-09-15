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



## [`Centum\Interfaces\Access\AccessInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Access/AccessInterface.php)

```php
allow(
    non-empty-string $user,
    non-empty-string $activityName
): void
```

```php
deny(
    non-empty-string $user,
    non-empty-string $activityName
): void
```

```php
remove(
    non-empty-string $user,
    non-empty-string $activityName
): void
```

```php
isAllowed(
    non-empty-string $user,
    non-empty-string $activityName
): bool
```

```php
verify(
    non-empty-string $user,
    non-empty-string $activityName
): void
```



## [`Centum\Interfaces\Access\ActivityInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Access/ActivityInterface.php)

```php
getName(): non-empty-string
```

```php
allow(
    non-empty-string $user
): void
```

```php
deny(
    non-empty-string $user
): void
```

```php
remove(
    non-empty-string $user
): void
```

```php
isAllowed(
    non-empty-string $user
): bool
```
