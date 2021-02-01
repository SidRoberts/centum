<?php

namespace Centum\Console\Terminal;

use Centum\Console\Terminal;

class BufferedTerminal extends Terminal
{
    protected string $output = "";



    public function write(string $string) : void
    {
        $this->output .= $string;
    }



    public function getContent() : string
    {
        return $this->output;
    }
}
