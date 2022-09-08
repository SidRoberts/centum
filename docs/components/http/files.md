---
layout: default
title: Files
parent: Http
grand_parent: Components
---



# Files

...



## Files Factory

You can obtain a Files object made with global variables using the [FilesFactory](https://github.com/SidRoberts/centum/blob/development/src/Http/FilesFactory.php):

```php
use Centum\Http\FilesFactory;

$filesFactory = new FilesFactory();

$files = $filesFactory->createFromGlobals();
```
