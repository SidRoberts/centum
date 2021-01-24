---
layout: default
title: Mvc
has_children: true
permalink: mvc
---



## Usage

**A working example is coming soon.**

This library can be divided into three components:
* [Application](https://github.com/SidRoberts/centum/blob/development/src/Mvc/Application.php):
  couples Router and Dispatcher together.
  It is better able to deal with 404 errors and returns Symfony Response objects.
* [Router](https://github.com/SidRoberts/centum/blob/development/src/Mvc/Router.php):
  takes a URL and determines which action method should be executed.
* [Dispatcher](https://github.com/SidRoberts/centum/blob/development/src/Mvc/Dispatcher.php):
  executes the Controller code.
