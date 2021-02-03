---
layout: default
title: Usage
parent: Container
---



Let's start by defining some of our services.

First of all, we need to be able to access our configuration data:

```php
namespace App\Service;

use Centum\Config\Config;
use Centum\Container\Service;

class ConfigService extends Service
{
    public function getName() : string
    {
        return "config";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve()
    {
        $config = new Config(
            [
                "pheanstalk" => [
                    "host" => "localhost",
                    "port" => 11300,
                ],
            ]
        );

        return $config;
    }
}
```

[Service classes](https://github.com/SidRoberts/centum/blob/development/src/Container/Service.php) have 3 methods:

* `getName()` allows you to specify the name that you'll use to access this service.

* `isShared()` allows you to reuse the same instance multiple times (`true`) or use the service as a singleton (`false`).

* `resolve()` is where you can actually write your service code.

A service may depend on another service in order to function.
By using the names from `getName()`, you can access other services via the `resolve()` method's parameters.
Here, we'll create another service that requires the 'config' service:

```php
namespace App\Service;

use Centum\Config\Config;
use Centum\Container\Service;
use Pheanstalk\Pheanstalk;

class PheanstalkService extends Service
{
    public function getName() : string
    {
        return "pheanstalk";
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve(Config $config)
    {
        $pheanstalk = new Pheanstalk(
            $config->pheanstalk->host,
            $config->pheanstalk->port
        );

        return $pheanstalk;
    }
}
```

The example above has used typehinting to ensure that `$config` is an instance of [`Centum\Config\Config`](https://github.com/SidRoberts/centum/blob/development/src/Config/Config.php).
This isn't necessary but it's for useful for IDE autocompletion and may help uncover possible bugs earlier.

Now we need to add these service classes to the container:

```php
use App\Service\ConfigService;
use App\Service\PheanstalkService;
use Centum\Container\Container;

$container = new Container();

$container->add(
    new ConfigService()
);

$container->add(
    new PheanstalkService()
);
```

Accessing services is now as simple as:

```php
$pheanstalk = $container->get("pheanstalk");
```

The container will handle all of the dependencies and either return the same instance or create a fresh instance depending on whether the service is shared or not.

If a service does not exist, `get()` will throw a [`Centum\Container\Exception\ServiceNotFoundException`](https://github.com/SidRoberts/centum/blob/development/src/Container/Exception/ServiceNotFoundException.php).
You can also check if a service exists using `has()` which will return a boolean:

```php
$container->has("myService");
```
