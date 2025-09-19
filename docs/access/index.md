---
layout: default
title: Access Component
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

- **`$default`**: Sets the default access policy (`ALLOW` or `DENY`) for activities not explicitly configured.

{: .callout.info }
[`Centum\Access\Access`](https://github.com/SidRoberts/centum/blob/main/src/Access/Access.php) implements [`Centum\Interfaces\Access\AccessInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Access/AccessInterface.php).



## Constants

- `Centum\Access\Access::ALLOW` — Allow access
- `Centum\Access\Access::DENY` — Deny access



## Links

- [Source code (`src/Access/`)](https://github.com/SidRoberts/centum/blob/main/src/Access/)
- [Interfaces (`src/Interfaces/Access/`)](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Access/)
- [Unit tests (`tests/Unit/Access/`)](https://github.com/SidRoberts/centum/blob/main/tests/Unit/Access/)
