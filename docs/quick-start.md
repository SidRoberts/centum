---
layout: default
title: Quick Start
permalink: quick-start
nav_order: 2
---



# Quick Start

## Skeleton Project

To start using Centum, a [skeleton project](https://github.com/SidRoberts/centum-project) can be created using Composer's `create-project` command:

```bash
composer create-project sidroberts/centum-project YOUR-PROJECT-NAME -s dev

cd YOUR-PROJECT-NAME
```

This will create a new project in the `YOUR-PROJECT-NAME` directory.

You can then use Docker to test the framework locally:

```bash
docker compose up
```

Open [http://localhost/](http://localhost/) in your browser and you should see a welcome page powered by Centum.

From here, you can begin creating controllers, models, and views to build your application.
The documentation will guide you through each component step by step.



### Folder Structure

By default, the `App` namespace is used and has this folder structure:

```text
bin/
    centum
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
        en.php
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

`composer analyse`
: Run Psalm static analyser.

`composer test`
: Run Codeception tests.

`composer test-coverage`
: Run Codeception tests with code coverage (see `tests/_output/coverage/index.html` after running).

`composer format`
: Fix any coding standard issues in the code.
