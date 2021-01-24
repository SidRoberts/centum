<?php

namespace Centum\Flash;

class MessageBag
{
    protected array $messages = [];



    public function add(string $level, string $message)
    {
        $this->messages[] = [
            "level" => $level,
            "message" => $message,
        ];
    }



    public function getMessages() : array
    {
        return $this->messages;
    }
}
