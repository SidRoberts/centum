---
layout: default
title: Injecting Objects
parent: Router
grand_parent: Components
permalink: router/injecting-objects
nav_order: 3
---



# Injecting Objects

As well as Route Parameters, regular objects from the Container can be injected into a Controller method:

```php
namespace App\Web\Controllers;

use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Http\SessionInterface;
use Centum\Interfaces\Router\ControllerInterface;

class UserController implements ControllerInterface
{
    public function logout(SessionInterface $session): ResponseInterface
    {
        $session->clear();
    }
}
```

Thanks to [`Centum\Container\Resolver\RouterRequestResolver`](https://github.com/SidRoberts/centum/blob/main/src/Container/Resolver/RouterRequestResolver.php), you also have direct access to things within the Request:

- [`DataInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/DataInterface.php)
- [`HeadersInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/HeadersInterface.php)
- [`CookiesInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/CookiesInterface.php)
- [`FilesInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/FilesInterface.php)
- Individual [`CookieInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/CookiesInterface.php) objects
- Individual [`FileGroupInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/FilesInterface.php) objects

For example, to access the HTTP Headers from within a Controller:

```php
namespace App\Web\Controllers;

use Centum\Interfaces\Http\HeadersInterface;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

class IndexController implements ControllerInterface
{
    public function index(HeadersInterface $headers): ResponseInterface
    {
        // ...
    }
}
```

In this example, we can access a Cookie with the ID of `theme` and a File Group with the ID of `files`:

```php
namespace App\Web\Controllers;

use Centum\Interfaces\Http\CookieInterface;
use Centum\Interfaces\Http\FileGroupInterface;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

class UploadController implements ControllerInterface
{
    public function submit(CookieInterface $theme, FileGroupInterface $files): ResponseInterface
    {
        // ...
    }
}
```

If the Cookie or File Group is optional, then you can make the parameter optional:

```php
namespace App\Web\Controllers;

use Centum\Interfaces\Http\CookieInterface;
use Centum\Interfaces\Http\ResponseInterface;
use Centum\Interfaces\Router\ControllerInterface;

class ProfileController implements ControllerInterface
{
    public function index(?CookieInterface $theme): ResponseInterface
    {
        // ...
    }
}
```
