---
layout: default
title: Whitelisted Functions
parent: Twig
---



# Whitelisted Functions

```php
use Centum\Twig\WhitelistedFunctionsExtension;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader("resources/twig/");

$twig = new Environment($loader);



$whitelistedFunctions = [
    "ucfirst",
    "lcfirst",
    "number_format",
    // ...
];



$twig->addExtension(
    new WhitelistedFunctionsExtension(
        $whitelistedFunctions
    )
);
```

Within your Twig files, you can now use these functions:

```twig
{% raw %}{{ ucfirst('the first letter will be capitalised.') }}{% endraw %}
```

For bonus points, set your whitelisted functions in a config file. ;)
