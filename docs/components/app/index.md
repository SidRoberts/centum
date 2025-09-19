---
layout: default
title: App Component
has_children: true
permalink: app
---



# `Centum\App`

The App component provides the entry points and bootstrapping logic for Centum application, handling both web and CLI environments.



## Overview

- [`Centum\App\WebBootstrap`](https://github.com/SidRoberts/centum/blob/main/src/App/WebBootstrap.php): Boots the application for HTTP requests.
- [`Centum\App\ConsoleBootstrap`](https://github.com/SidRoberts/centum/blob/main/src/App/WebBootstrap.php): Boots the application for CLI commands.

Check out [`SidRoberts/centum-project`](https://github.com/SidRoberts/centum-project) for working examples.



## Web Example

To start the web application, use `public/index.php`:

```php
<?php

require __DIR__ . "/../vendor/autoload.php";

use Centum\App\WebBootstrap;

$container = require __DIR__ . "/../config/container.php";

$bootstrap = $container->get(WebBootstrap::class);

$bootstrap->boot($container);
```



## CLI Example

To start the CLI application, use `bin/centum`:

```php
#!/usr/bin/env php
<?php

use Centum\App\ConsoleBootstrap;

require_once __DIR__ . "/../vendor/autoload.php";

$container = require __DIR__ . "/../config/container.php";

$bootstrap = $container->get(ConsoleBootstrap::class);

$bootstrap->boot($container);
```



## Links

- [Source code (`src/App/`)](https://github.com/SidRoberts/centum/blob/main/src/App/)
- [Interfaces (`src/Interfaces/App/`)](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/App/)
- [Unit tests (`tests/Unit/App/`)](https://github.com/SidRoberts/centum/blob/main/tests/Unit/App/)
