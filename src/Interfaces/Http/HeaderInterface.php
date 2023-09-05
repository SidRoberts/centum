<?php

namespace Centum\Interfaces\Http;

interface HeaderInterface
{
    /**
     * @return non-empty-string
     */
    public function getName(): string;

    public function getValue(): string;



    /**
     * @return non-empty-string
     */
    public function getHeaderString(): string;



    public function send(): void;



    /**
     * @return non-empty-string
     */
    public function __toString(): string;
}
