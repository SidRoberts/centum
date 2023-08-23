---
layout: default
title: Whitelists and Blacklists
parent: Access
grand_parent: Components
permalink: access/whitelists-and-blacklists
nav_order: 1
---



# Whitelists and Blacklists

The Access component can be used as a whitelist or blacklist by setting the default value with the `ALLOW` or `DENY` constants.
By default, `Access` uses `ALLOW`, meaning that it will act as a whitelist.

## Whitelist

A whitelist means that users are allowed to do anything unless explicitly stated otherwise.

```php
use Centum\Access\Access;

$access = new Access(
    Access::ALLOW
);
```

## Blacklist

A blacklist means that users are not allowed to do anything unless explicitly stated otherwise.

```php
use Centum\Access\Access;

$access = new Access(
    Access::DENY
);
```
