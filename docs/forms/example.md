---
layout: default
title: Example
parent: Forms
---



# Example

Let's create a login form with a email and a password field.
First, we need to create these fields:

```php
use Centum\Forms\Field;

$emailField = new Field("email");

$passwordField = new Field("password");
```

Now we need to add some filters and validators to these fields.
Obviously, neither of these fields should be empty and the email field should contain a valid email address:

```php
use Centum\Filter\String\Trim;
use Centum\Validator\EmailAddress;
use Centum\Validator\NotEmpty;



$emailField->addFilter(
    new Trim()
);

$emailField->addValidator(
    new NotEmpty()
);

$emailField->addValidator(
    new EmailAddress()
);



$passwordField->addValidator(
    new NotEmpty()
);
```

Filters are applied before validating the data.

Now we need to encapsulate them into a Form:

```php
use Centum\Forms\Form;

$loginForm = new Form();

$loginForm->add($emailField);

$loginForm->add($passwordField);
```

Validating data against these filters and validators is as easy as:

```php
$status = $loginForm->validate($_POST);

$success = $status->isValid();
```

If the data isn't valid, you can find out why:

```php
$status = $loginForm->validate($_POST);

$errorMessages = $status->getMessages();
```
