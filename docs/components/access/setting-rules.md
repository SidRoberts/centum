---
layout: default
title: Setting Rules
parent: Access
grand_parent: Components
permalink: access/setting-rules
nav_order: 2
---



# Setting Rules

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
