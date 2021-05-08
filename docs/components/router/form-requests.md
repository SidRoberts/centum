---
layout: default
title: Form Requests
parent: Router
grand_parent: Components
---



# Form Requests

Within web apps, [forms](../forms/index.md) can be utilised to process and validate Request data (GET, POST, ...).

As an example, you may wish to allow users to submit their email address to be added to a newsletter.
A simple Form that validates email addresses can be created:

```php
namespace App\Forms;

use Centum\Forms\Field;
use Centum\Forms\FormTemplate;
use Centum\Validator\EmailAddress;

class SubscriptionTemplate extends FormTemplate
{
    public function emailAddress(Field $field): void
    {
        $field->addValidator(
            new EmailAddress()
        );
    }
}
```

```php
use App\Forms\SubscriptionTemplate;
use Centum\Forms\FormFactory;

$subscriptionTemplate = new SubscriptionTemplate();

$subscriptionForm = FormFactory::createFromTemplate($subscriptionTemplate);
```

Routes can be assigned a form, as briefly mentioned in [Routes](routes.md):

```php
use App\Controllers\SubscribeController;

$group = $router->group();

$group->post("/subscribe", SubscribeController::class, "submit", $subscriptionForm);
```

Now this route will only match if the data is valid.
If the Request data does not fulfil the Form then a [`FormRequestException`](https://github.com/SidRoberts/centum/tree/development/src/Router/Exception/FormRequestException.php) is thrown.
You can catch this using an [exception handler](exception-handlers.md).

```php
use Centum\Http\Request;

$request = new Request(
    "/subscribe",
    "POST",
    [
        "emailAddress" => "sid@sidroberts.co.uk",
    ]
);

$response = $router->handle($request);
```
