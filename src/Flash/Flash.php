<?php

namespace Centum\Flash;

use Centum\Interfaces\Flash\FlashInterface;
use Centum\Interfaces\Flash\FormatterInterface;
use Centum\Interfaces\Flash\MessageBagInterface;
use Centum\Interfaces\Http\SessionInterface;

class Flash implements FlashInterface
{
    public const SESSION_ID = "_flashMessages";



    public function __construct(
        protected readonly SessionInterface $session,
        protected readonly FormatterInterface $formatter
    ) {
    }



    public function success(string $text): void
    {
        $this->add("success", $text);
    }

    public function info(string $text): void
    {
        $this->add("info", $text);
    }

    public function warning(string $text): void
    {
        $this->add("warning", $text);
    }

    public function danger(string $text): void
    {
        $this->add("danger", $text);
    }

    protected function add(string $level, string $text): void
    {
        $messageBag = $this->getMessageBag();

        $message = new Message($level, $text);

        $messageBag->add($message);

        $this->session->set(self::SESSION_ID, $messageBag);
    }



    public function output(): string
    {
        $messageBag = $this->getMessageBag();

        $messages = $messageBag->getMessages();

        $output = "";

        foreach ($messages as $message) {
            $output .= $this->formatter->output($message) . PHP_EOL;
        }

        return $output;
    }



    protected function getMessageBag(): MessageBagInterface
    {
        /** @var MessageBagInterface */
        $messageBag = $this->session->get(self::SESSION_ID) ?? new MessageBag();

        $this->session->remove(self::SESSION_ID);

        return $messageBag;
    }
}
