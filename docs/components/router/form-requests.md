---
layout: default
title: Form Requests
parent: Router
grand_parent: Components
---



# Form Requests

Within web apps, [forms](../forms/index.md) can be utilised to process and validate Request data (GET, POST, ...).
Routes can be assigned a Form instead of manually creating one within a Controller, as briefly mentioned in [Routes](routes.md).

As an example, you may wish to allow users to submit their email address to be added to a newsletter.
First, we need to create a Form Template that validates and lowercases email addresses:

```php
namespace App\Forms;

use Centum\Forms\Field;
use Centum\Forms\FormTemplate;
use Centum\Filter\String\ToLower;
use Centum\Validator\EmailAddress;

class SubscriptionTemplate extends FormTemplate
{
    public function emailAddress(Field $field): void
    {
        $field->addFilter(
            new ToLower()
        );

        $field->addValidator(
            new EmailAddress()
        );
    }
}
```

Now we can convert it to a Form and create a Route with it:

```php
use App\Controllers\SubscribeController;
use App\Forms\SubscriptionTemplate;
use Centum\Forms\FormFactory;

$subscriptionTemplate = new SubscriptionTemplate();

$formFactory = new FormFactory();

$subscriptionForm = $formFactory->createFromTemplate($subscriptionTemplate);



$group = $router->group();

$group->post("/subscribe", SubscribeController::class, "submit", $subscriptionForm);
```

By getting the [`FormRequest`](https://github.com/SidRoberts/centum/tree/development/src/Http/FormRequest.php) object in the controller, you can check to see if the form is valid and you can also get the filtered values.
In this case, `$emailAddress` will always be lower case as described in the Form Template.
You can also bind all of the fields to an entity, such as a model:

```php
namespace App\Controllers;

use App\Models\User;
use Centum\Http\FormRequest;
use Centum\Http\Response;

class SubscribeController
{
    public function submit(FormRequest $formRequest): Response
    {
        if (!$formRequest->isValid()) {
            return new Response("subscription failed");
        }

        $emailAddress = $formRequest->get("emailAddress");

        $user = new User();

        $formRequest->bind($user);

        // subscribe($emailAddress)

        return new Response(
            sprintf(
                "%s has been subscribed",
                $user->getEmailAddress()
            )
        );
    }
}
```
