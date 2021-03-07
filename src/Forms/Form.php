<?php

namespace Centum\Forms;

class Form
{
    /**
     * @var Field[]
     */
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

        /**
         * @var Field $field
         */
        foreach ($this->fields as $name => $field) {
            /**
             * @var mixed
             */
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



        $field = $this->fields[$name];

        return $field->getMessages($value);
    }
}
