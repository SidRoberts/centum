<?php

namespace Centum\Interfaces\Forms;

interface FormInterface
{
    public function add(FieldInterface $field): void;



    public function getFilteredValues(array $data): array;



    public function validate(array $data): StatusInterface;
}
