---
layout: default
title: Quick Start
permalink: quick-start
nav_order: 2
---



# Quick Start

## Skeleton Project

A skeleton project can be created using Composer's `create-project` command:

```bash
composer create-project sidroberts/centum-project YOUR-PROJECT-NAME -s dev

cd YOUR-PROJECT-NAME

docker compose up
```

This skeleton project is available on GitHub as [SidRoberts/centum-project](https://github.com/SidRoberts/centum-project).



### Folder Structure

By default, the `App` namespace is used and has this folder structure:

```text
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
    translations/
    twig/
src/
    Console/
        Commands/
        ExceptionHandlers/
    Filters/
    Models/
    Observers/
    Services/
    Tasks/
    Validators/
    Web/
        Controllers/
        ExceptionHandlers/
        Forms/
        Middlewares/
        Replacements/
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



## Custom Composer Scripts

| Command                  | Description                                                                                       |
| ------------------------ | ------------------------------------------------------------------------------------------------- |
| `composer analyse`       | Run Psalm static analyser.                                                                        |
| `composer test`          | Run Codeception tests.                                                                            |
| `composer test-coverage` | Run Codeception tests with code coverage (see `tests/_output/coverage/index.html` after running). |
| `composer format`        | Fix any coding standard issues in the code.                                                       |
