<?php

namespace Centum\Forms;

class Status
{
    protected array $messages;



    public function __construct(array $messages)
    {
        $this->messages = $messages;
    }



    public function isValid(): bool
    {
        return (count($this->messages) === 0);
    }

    public function getMessages(): array
    {
        return $this->messages;
    }
}
