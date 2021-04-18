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
        Console/
        Web/
    Models/
    Observers/
    Tasks/
tests/
    _data/
    _output/
    _support/
        FunctionalTester.php
        UnitTester.php
    functional/
    unit/
codeception.yml
composer.json
docker-compose.yml
psalm.xml
```

...
