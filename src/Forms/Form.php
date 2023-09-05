<?php

namespace Centum\Forms;

use Centum\Interfaces\Forms\FieldInterface;
use Centum\Interfaces\Forms\FormInterface;
use Centum\Interfaces\Forms\StatusInterface;

class Form implements FormInterface
{
    /**
     * @var array<string, FieldInterface>
     */
    protected array $fields = [];



    public function add(FieldInterface $field): void
    {
        $name = $field->getName();

        $this->fields[$name] = $field;
    }



    /**
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    public function getFilteredValues(array $data): array
    {
        /** @var array<string, mixed> */
        $filteredValues = [];

        foreach ($this->fields as $name => $field) {
            /** @var mixed */
            $value = $data[$name] ?? null;

            /** @var mixed */
            $filteredValues[$name] = $field->getFilteredValue($value);
        }

        return $filteredValues;
    }



    /**
     * @param array<string, mixed> $data
     */
    public function validate(array $data): StatusInterface
    {
        $messages = [];

        foreach ($this->fields as $name => $field) {
            /** @var mixed */
            $value = $data[$name] ?? null;

            $fieldMessages = $field->getMessages($value);

            if (count($fieldMessages) > 0) {
                $messages[$name] = $fieldMessages;
            }
        }

        return new Status($messages);
    }
}
