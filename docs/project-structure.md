---
layout: default
title: Project Structure
nav_order: 3
---



# Project Structure

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
composer.json
```

...
