---
layout: default
title: Injecting Objects
parent: Router
grand_parent: Components
permalink: router/injecting-objects
nav_order: 3
---



# Injecting Objects

In Centum, in addition to Route Parameters, you can also inject regular objects from the Container directly into your Controller methods.

For example, consider a simple `UserController` where we want to clear the user session when logging out:

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

        return new Response("Session cleared.");
    }
}
```

Here, the `SessionInterface` object is automatically injected into the `logout` method, giving you direct access to session operations without any additional boilerplate code.

Thanks to [`Centum\Container\Resolver\RequestResolver`](https://github.com/SidRoberts/centum/blob/main/src/Container/Resolver/RequestResolver.php), you can also directly access objects that are part of the current HTTP request.
This includes things like request data, headers, cookies, and uploaded files.
The resolver ensures that these objects are automatically provided to your controller methods when requested.

Available injectable interfaces include:

- [`DataInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/DataInterface.php) – to access form or query data
- [`HeadersInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/HeadersInterface.php) – to read HTTP headers
- [`CookiesInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/CookiesInterface.php) – to work with multiple cookies at once
- [`FilesInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/FilesInterface.php) – to handle multiple uploaded files
- Individual [`CookieInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/CookiesInterface.php) objects – for single cookies
- Individual [`FileGroupInterface`](https://github.com/SidRoberts/centum/blob/main/src/Interfaces/Http/FilesInterface.php) objects – for specific groups of uploaded files

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

Similarly, you can access individual cookies and file groups in your methods.
In the example below, we access a cookie with the ID `theme` and a file group with the ID `files`:

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

If certain cookies or file groups are optional, you can make them optional parameters in your controller method by prefixing them with `?`.
For example:

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

This approach allows for clean and maintainable controller methods, where dependencies are injected automatically, and you don’t need to manually fetch objects from the Container or the Request.
It helps keep your code concise while still giving full access to HTTP request details and other container-managed services.
