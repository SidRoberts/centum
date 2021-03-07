<?php

namespace Centum\Flash;

class MessageBag
{
    /**
     * @var Message[]
     */
    protected array $messages = [];



    public function add(Message $message) : void
    {
        $this->messages[] = $message;
    }



    public function getMessages() : array
    {
        return $this->messages;
    }
}
