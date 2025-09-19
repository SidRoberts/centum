---
layout: default
title: Setting Rules
parent: Access
grand_parent: Components
permalink: access/setting-rules
nav_order: 2
---



# Setting Rules

You can define access control rules using the `allow()` and `deny()` methods:

```php
$access->allow("admin", "delete-a-user");      // Allow "admin" to delete a user
$access->deny("moderator", "delete-a-user");   // Deny "moderator" from deleting a user
```



## Checking Permissions

To check if a user or group is allowed to perform an action, use `isAllowed()`:

```php
use Exception;

if (!$access->isAllowed("moderator", "delete-a-user")) {
    throw new Exception("Access denied.");
}

$user->delete();
```



## Enforcing Permissions

For convenience, you can use the `verify()` method.
This method will throw an [`AccessDeniedException`](https://github.com/SidRoberts/centum/blob/main/src/Access/Exception/AccessDeniedException.php) if the user is not allowed:

```php
$access->verify("moderator", "delete-a-user");

$user->delete();
```
