<?php

namespace Centum\Interfaces\Forms;

use Centum\Forms\Field;
use Centum\Forms\Status;

interface FormInterface
{
    public function add(Field $field): void;



    public function getFilteredValues(array $data): array;



    public function validate(array $data): Status;
}
