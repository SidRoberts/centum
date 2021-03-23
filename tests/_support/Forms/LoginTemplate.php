<?php

namespace Tests\Forms;

use Centum\Forms\Field;
use Centum\Forms\FormTemplate;
use Laminas\Filter\StringTrim;
use Laminas\Validator\NotEmpty;

class LoginTemplate extends FormTemplate
{
    public function username(Field $field) : void
    {
        $field->addFilter(
            new StringTrim()
        );

        $field->addValidator(
            new NotEmpty()
        );
    }

    public function password(Field $field) : void
    {
        $field->addValidator(
            new NotEmpty()
        );
    }
}
