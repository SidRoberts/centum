---
layout: default
title: Console
parent: Apps
has_children: true
permalink: apps/console
---



# Console Apps

Application endpoints are treated as [Command](https://github.com/SidRoberts/centum/blob/development/src/Console/Command.php) objects.
These Commands contain all of the code and metadata relating to that endpoint.

The [Application](https://github.com/SidRoberts/centum/blob/development/src/Console/Application.php) extracts the command name from `$argv`, finds the appropriate Command, runs the Middlewares, and then executes the Command's code.
