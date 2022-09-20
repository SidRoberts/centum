<?php

namespace Centum\Http;

class Csrf
{
    protected Session $session;

    public const TOKEN = "centum-csrf";

    public const LENGTH = 32;



    public function __construct(Session $session)
    {
        $this->session = $session;
    }



    public function get(): string
    {
        /** @var string */
        $csrf = $this->session->get(self::TOKEN) ?? $this->generate();

        return $csrf;
    }

    public function generate(): string
    {
        $randomBinaryString = random_bytes(self::LENGTH / 2);

        $csrf = bin2hex($randomBinaryString);

        $this->session->set(self::TOKEN, $csrf);
        
        return $csrf;
    }

    public function reset(): void
    {
        $this->session->remove(self::TOKEN);
    }



    public function validate(string $value): bool
    {
        return $this->get() === $value;
    }
}
