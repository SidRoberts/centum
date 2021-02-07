---
layout: default
title: YAML
parent: Config
---



The Config Factory makes it very easy to access your configuration data from a YAML file:

```php
use Centum\Config\Config;
use Centum\Config\Factory;

/**
 * @var Config
 */
$config = Factory::yaml("path/to/config.yml");
```
