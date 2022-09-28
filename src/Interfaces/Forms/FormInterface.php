<?php

namespace Centum\Interfaces\Forms;

use Centum\Forms\Field;

interface FormInterface
{
    public function add(Field $field): void;



    public function getFilteredValues(array $data): array;



    public function validate(array $data): StatusInterface;
}
