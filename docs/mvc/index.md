---
layout: default
title: Mvc
has_children: true
permalink: mvc
---



This interpretation of MVC differs slightly from others.

Instead of controllers with multiple action methods, this one treats every application endpoint as a [Route](https://github.com/SidRoberts/centum/blob/development/src/Mvc/Route.php) object - in place of controllers.
These Routes contain all of the code and metadata relating to that endpoint.

The [Router](https://github.com/SidRoberts/centum/blob/development/src/Mvc/Router.php) essentially converts a [Request](https://github.com/SidRoberts/centum/blob/development/src/Http/Request.php) object into a [Response](https://github.com/SidRoberts/centum/blob/development/src/Http/Response.php) object.
It does so by extracting the Request's URI, it iterates through the Routes until it finds one that matches, and then executes the Route's code which returns a Response.
