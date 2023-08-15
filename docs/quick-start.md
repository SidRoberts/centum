---
layout: default
title: Quick Start
nav_order: 2
---



# Quick Start

## Skeleton Project

A skeleton project can be created using Composer's `create-project` command:

```bash
composer create-project sidroberts/centum-project YOUR-PROJECT-NAME -s dev

cd YOUR-PROJECT-NAME

docker-compose up
```

This skeleton project is available on GitHub as [SidRoberts/centum-project](https://github.com/SidRoberts/centum-project).



### Folder Structure

By default, the `App` namespace is used and has this folder structure:

```
config/
    console.php
    container.php
    router.php
public/
    index.php
resources/
    docker/
        nginx.conf
        php.ini
    twig/
src/
    Commands/
    Controllers/
    Filters/
    Forms/
    Middlewares/
    Models/
    Observers/
    Tasks/
    Validators/
tests/
    _output/
    Console/
    Support/
        Data/
        ConsoleTester.php
        UnitTester.php
        WebTester.php
    Unit/
    Web/
codeception.yml
composer.json
docker-compose.yml
psalm.xml
```

...
