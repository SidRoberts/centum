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



    public function validate(array $data): Status
    {
        $messages = [];

        /**
         * @var Field $field
         */
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
