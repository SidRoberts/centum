---
layout: default
title: Whitelisted Functions
parent: Twig
grand_parent: Components
permalink: twig/whitelisted-functions
nav_order: 5
---



# Whitelisted Functions

```php
use Centum\Twig\WhitelistedFunctionsExtension;
use Twig\Environment;

/** @var Environment $twig */

$twig->addExtension(
    new WhitelistedFunctionsExtension(
        [
            "ucfirst",
            "lcfirst",
            "number_format",
            // ...
        ]
    )
);
```

Within your Twig files, you can now use these functions:

```twig
{% raw %}{{ ucfirst('the first letter will be capitalised.') }}{% endraw %}
```

For bonus points, set your whitelisted functions in a config file. ;)
