<?php

namespace Centum\Forms;

class Form
{
    /**
     * @var array<string, Field>
     */
    protected array $fields = [];



    public function add(Field $field): void
    {
        $name = $field->getName();

        $this->fields[$name] = $field;
    }


    public function getFilteredValues(array $data): array
    {
        $filteredValues = [];

        foreach ($this->fields as $name => $field) {
            /**
             * @var mixed
             */
            $value = $data[$name] ?? null;

            /**
             * @var mixed
             */
            $filteredValues[$name] = $field->getFilteredValue($value);
        }

        return $filteredValues;
    }

    public function validate(array $data): Status
    {
        $messages = [];

        foreach ($this->fields as $name => $field) {
            /**
             * @var mixed
             */
            $value = $data[$name] ?? null;

            $fieldMessages = $field->getMessages($value);

            if (count($fieldMessages) > 0) {
                $messages[$name] = $fieldMessages;
            }
        }

        return new Status($messages);
    }
}
