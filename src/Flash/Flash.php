<?php

namespace Centum\Flash;

use Centum\Http\Session;

class Flash implements FlashInterface
{
    protected Session $session;

    protected FormatterInterface $formatter;



    const SESSION_ID = "_flashMessages";



    public function __construct(Session $session, FormatterInterface $formatter)
    {
        $this->session   = $session;
        $this->formatter = $formatter;
    }



    public function success(string $message) : void
    {
        $this->add("success", $message);
    }

    public function info(string $message) : void
    {
        $this->add("info", $message);
    }

    public function warning(string $message) : void
    {
        $this->add("warning", $message);
    }

    public function danger(string $message) : void
    {
        $this->add("danger", $message);
    }

    protected function add(string $level, string $message) : void
    {
        $messageBag = $this->getMessageBag();

        $messageBag->add($level, $message);

        $this->session->set(self::SESSION_ID, $messageBag);
    }



    public function output() : string
    {
        $messageBag = $this->getMessageBag();

        $messages = $messageBag->getMessages();

        $output = "";

        foreach ($messages as $message) {
            $formattedMessage = $this->formatter->output(
                $message["level"],
                $message["message"]
            );

            $output .= $formattedMessage . PHP_EOL;
        }

        return $output;
    }



    protected function getMessageBag() : MessageBag
    {
        $messageBag = $this->session->get(self::SESSION_ID);

        if ($messageBag === null) {
            return new MessageBag();
        }

        $this->session->remove(self::SESSION_ID);

        return $messageBag;
    }
}
