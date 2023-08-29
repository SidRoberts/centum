<?php

namespace Centum\Flash;

use Centum\Interfaces\Flash\MessageBagInterface;
use Centum\Interfaces\Flash\StorageInterface;
use Centum\Interfaces\Http\SessionInterface;

class Storage implements StorageInterface
{
    public const SESSION_ID = "centum-flash";



    public function __construct(
        protected readonly SessionInterface $session
    ) {
    }



    public function get(): MessageBagInterface
    {
        /** @var MessageBagInterface */
        $messageBag = $this->session->get(self::SESSION_ID) ?? new MessageBag();

        $this->session->remove(self::SESSION_ID);

        return $messageBag;
    }

    public function set(MessageBagInterface $messageBag): void
    {
        $this->session->set(self::SESSION_ID, $messageBag);
    }

    public function reset(): void
    {
        $this->session->remove(self::SESSION_ID);
    }
}
