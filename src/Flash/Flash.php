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
        $this->add(Level::SUCCESS, $text);
    }

    public function info(string $text): void
    {
        $this->add(Level::INFO, $text);
    }

    public function warning(string $text): void
    {
        $this->add(Level::WARNING, $text);
    }

    public function danger(string $text): void
    {
        $this->add(Level::DANGER, $text);
    }

    protected function add(Level $level, string $text): void
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
