---
layout: default
title: Access
parent: Components
has_children: true
permalink: access
---



# `Centum\Access`

The Access component simplifies access control management for your application.

You can allow or deny users (or groups of users) the privilege to perform specific activities.
Both activities and users/groups are identified by simple string identifiers for ease of use.



## Constructor

```php
Centum\Access\Access(
    bool $default = Centum\Access\Access::ALLOW
);
```

- **$default**: Sets the default access policy (`ALLOW` or `DENY`) for activities not explicitly configured.

{: .highlight }
[`Centum\Access\Access`](https://github.com/SidRoberts/centum/blob/development/src/Access/Access.php) implements [`Centum\Interfaces\Access\AccessInterface`](https://github.com/SidRoberts/centum/blob/development/src/Interfaces/Access/AccessInterface.php).



## Constants

- `Centum\Access\Access::ALLOW` — Allow access
- `Centum\Access\Access::DENY` — Deny access
