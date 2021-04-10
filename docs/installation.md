---
layout: default
title: Installation
nav_order: 2
---



# Installation

## Technologies

Centum uses the following technologies:

- [PHP 8](https://www.php.net/)
- [nginx](https://nginx.org/)
- [Composer](https://getcomposer.org/)
- [Docker Compose](https://docs.docker.com/compose/)
- [Codeception](https://codeception.com/)
- [Psalm](https://psalm.dev/)
- [Twig](https://twig.symfony.com/)

It is assumed that a developer using Centum at least has some familiarity with all of these items.



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
    container.php
public/
    index.php
resources/
    docker/
        nginx.conf
        php.ini
    twig/
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
psalm.xml
```

...
