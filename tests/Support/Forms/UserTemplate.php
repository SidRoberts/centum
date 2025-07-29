<?php

namespace Tests\Support\Forms;

use Centum\Filter\Cast\ToString;
use Centum\Filter\String\Trim;
use Centum\Forms\Field;
use Centum\Forms\FormTemplate;
use Centum\Validator\NotEmpty;

final class UserTemplate extends FormTemplate
{
    public function username(Field $field): void
    {
        $field->addFilter(
            new ToString()
        );

        $field->addFilter(
            new Trim()
        );

        $field->addValidator(
            new NotEmpty()
        );
    }

    public function password(Field $field): void
    {
        $field->addFilter(
            new ToString()
        );

        $field->addValidator(
            new NotEmpty()
        );
    }
}
