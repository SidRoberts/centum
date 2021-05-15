# Centum

Centum is an all-encompassing framework designed to simplify the building of MVC-style web applications.



[![Code Build Status](https://img.shields.io/github/workflow/status/SidRoberts/centum/tests/development.svg?style=for-the-badge)](https://github.com/SidRoberts/centum/actions)

[![GitHub issues](https://img.shields.io/github/issues-raw/SidRoberts/centum.svg?style=for-the-badge)](https://github.com/SidRoberts/centum/issues)
[![GitHub pull requests](https://img.shields.io/github/issues-pr-raw/SidRoberts/centum.svg?style=for-the-badge)](https://github.com/SidRoberts/centum/pulls)



## Features

- [Access](https://sidroberts.co.uk/centum/components/access)
- [Console](https://sidroberts.co.uk/centum/components/console)
- [Container](https://sidroberts.co.uk/centum/components/container)
- [Cron](https://sidroberts.co.uk/centum/components/cron)
- [Filter](https://sidroberts.co.uk/centum/components/filter)
- [Flash](https://sidroberts.co.uk/centum/components/flash)
- [Forms](https://sidroberts.co.uk/centum/components/forms)
- [HTTP](https://sidroberts.co.uk/centum/components/http)
- [Queue](https://sidroberts.co.uk/centum/components/queue)
- [Router](https://sidroberts.co.uk/centum/components/router)
- [Twig](https://sidroberts.co.uk/centum/components/twig)
- [Url](https://sidroberts.co.uk/centum/components/url)
- [Validator](https://sidroberts.co.uk/centum/components/validator)
- [Codeception module](https://sidroberts.co.uk/centum/components/codeception)



## Documentation

[![Docs Build Status](https://img.shields.io/github/deployments/SidRoberts/centum/github-pages?style=for-the-badge)](https://sidroberts.co.uk/centum)

Documentation is available at [https://sidroberts.co.uk/centum](https://sidroberts.co.uk/centum) and in the [docs/](docs/) folder.



## Quick Start

```bash
composer create-project sidroberts/centum-project YOUR-PROJECT-NAME -s dev

cd YOUR-PROJECT-NAME

docker-compose up
```

[Read more in the documentation](https://sidroberts.co.uk/centum/quick-start).



## Testing

```bash
vendor/bin/codecept run
```



## Technologies

Centum uses the following technologies:

- [PHP 8](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [Twig](https://twig.symfony.com/)
- [Beanstalkd](https://beanstalkd.github.io/)

### Testing

- [Codeception](https://codeception.com/)
- [Psalm](https://psalm.dev/)



## License

[![License](https://img.shields.io/github/license/SidRoberts/centum?style=for-the-badge)](LICENSE.md)

See [LICENSE.md](LICENSE.md) for more details.

© [Sid Roberts](https://github.com/SidRoberts)
