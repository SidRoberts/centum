<?php

namespace Centum\Http\Csrf;

use Centum\Interfaces\Http\Csrf\GeneratorInterface;
use Centum\Interfaces\Http\Csrf\StorageInterface;
use Centum\Interfaces\Http\SessionInterface;

class Storage implements StorageInterface
{
    public function __construct(
        protected readonly SessionInterface $session,
        protected readonly GeneratorInterface $generator
    ) {
    }



    public function get(): string
    {
        /** @var string|null */
        $value = $this->session->get(self::TOKEN);

        if ($value === null) {
            $value = $this->generator->generate();

            $this->set($value);
        }

        return $value;
    }

    public function set(string $newValue): void
    {
        $this->session->set(self::TOKEN, $newValue);
    }

    public function reset(): void
    {
        $this->session->remove(self::TOKEN);
    }
}
