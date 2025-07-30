---
layout: default
title: Whitelists and Blacklists
parent: Access
grand_parent: Components
permalink: access/whitelists-and-blacklists
nav_order: 1
---



# Whitelists and Blacklists

The Access component can be configured as either a whitelist or a blacklist by setting the default value using the `ALLOW` or `DENY` constants.

- **Whitelist**: Users are allowed to perform any action unless explicitly denied.
- **Blacklist**: Users are denied all actions unless explicitly allowed.

By default, `Access` uses `ALLOW`, so it acts as a whitelist.



## Whitelist Example

Allow all actions by default, and deny specific actions as needed:

```php
use Centum\Access\Access;

$access = new Access(
    Access::ALLOW
);

// Deny "guest" from "delete-post"
$access->deny("guest", "delete-post");

// "guest" can do anything except "delete-post"
```



## Blacklist Example

Deny all actions by default, and allow specific actions as needed:

```php
use Centum\Access\Access;

$access = new Access(
    Access::DENY
);

// Allow "admin" to "delete-post"
$access->allow("admin", "delete-post");

// "admin" can only "delete-post" unless more actions are allowed
```



## When to Use

- Use a **whitelist** when most users should have broad access, with only a few restrictions.
- Use a **blacklist** when access should be tightly controlled, granting permissions only as needed.
