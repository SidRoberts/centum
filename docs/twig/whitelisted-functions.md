---
layout: default
title: Whitelisted Functions
parent: Twig
---



```php
use Centum\TwigWhitelistedFunctions\WhitelistedFunctionsExtension;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader("views/");

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
{{ ucfirst('the first letter will be capitalised.') }}
```

For bonus points, set your whitelisted functions in a config file. ;)
