<?php

namespace Centum\Forms;

class Form
{
    protected array $fields = [];



    public function add(Field $field) : void
    {
        $name = $field->getName();

        $this->fields[$name] = $field;
    }



    public function isValid(array $data) : bool
    {
        $messages = $this->getMessages($data);

        return (count($messages) === 0);
    }



    public function getMessages(array $data) : array
    {
        $messages = [];

        foreach ($this->fields as $name => $field) {
            $value = $data[$name] ?? null;

            $fieldMessages = $this->getMessagesFor($name, $value);

            if (count($fieldMessages) > 0) {
                $messages[$name] = $fieldMessages;
            }
        }

        return $messages;
    }

    public function getMessagesFor(string $name, mixed $value) : array
    {
        if (!isset($this->fields[$name])) {
            return [];
        }



        /**
         * @var Field
         */
        $field = $this->fields[$name];

        return $field->getMessages($value);
    }
}
