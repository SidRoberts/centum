---
layout: default
title: Installation
nav_order: 2
---



# Installation

A skeleton project can be created using Composer's `create-project` command:

```bash
composer create-project sidroberts/centum-project
```

This skeleton project is available on GitHub as [SidRoberts/centum-project](https://github.com/SidRoberts/centum-project).

By default, the `App` namespace is used and has this folder structure:

```
config/
public/
    index.php
resources/
    docker/
        nginx.conf
        php.ini
src/
    Api/
        Controllers/
        Filters/
        Middlewares/
    Console/
        Commands/
        Filters/
        Middlewares/
    Forms/
    Models/
    Observers/
    Web/
        Controllers/
        Filters/
        Middlewares/
tests/
    _data/
    _output/
    _support/
        UnitTester.php
    unit/
codeception.yml
composer.json
docker-compose.yml
```

...
