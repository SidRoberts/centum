<?php

namespace Centum\Console\Terminal;

class Style
{
    /**
     * @param array<string> $items
     */
    public function list(array $items): string
    {
        $list = "";

        foreach ($items as $item) {
            $list .= sprintf(
                " - %s",
                $item
            ) . PHP_EOL;
        }

        return PHP_EOL . $list . PHP_EOL;
    }



    public function link(string $url, ?string $text = null): string
    {
        if ($text === "" || $text === null) {
            $text = $url;
        }

        if ($url === "") {
            return $text;
        }

        return "\e]8;;" . $url . "\e\\" . $text . "\e]8;;\e\\";
    }



    public function bold(string $text): string
    {
        return $this->embed(
            "\e[1m",
            $text,
            "\e[0m"
        );
    }

    public function italics(string $text): string
    {
        return $this->embed(
            "\e[3m",
            $text,
            "\e[23m"
        );
    }

    public function underline(string $text): string
    {
        return $this->embed(
            "\e[4m",
            $text,
            "\e[24m"
        );
    }

    public function highlight(string $text): string
    {
        return $this->embed(
            "\e[7m",
            $text,
            "\e[0m"
        );
    }

    public function dim(string $text): string
    {
        return $this->embed(
            "\e[2m",
            $text,
            "\e[0m"
        );
    }

    public function blink(string $text): string
    {
        return $this->embed(
            "\e[5m",
            $text,
            "\e[0m"
        );
    }

    public function reversed(string $text): string
    {
        return $this->embed(
            "\e[7m",
            $text,
            "\e[0m"
        );
    }



    public function textBlack(string $text): string
    {
        return $this->embed(
            "\e[30m",
            $text,
            "\e[0m"
        );
    }

    public function textRed(string $text): string
    {
        return $this->embed(
            "\e[31m",
            $text,
            "\e[0m"
        );
    }

    public function textGreen(string $text): string
    {
        return $this->embed(
            "\e[32m",
            $text,
            "\e[0m"
        );
    }

    public function textYellow(string $text): string
    {
        return $this->embed(
            "\e[33m",
            $text,
            "\e[0m"
        );
    }

    public function textBlue(string $text): string
    {
        return $this->embed(
            "\e[34m",
            $text,
            "\e[0m"
        );
    }

    public function textMagenta(string $text): string
    {
        return $this->embed(
            "\e[35m",
            $text,
            "\e[0m"
        );
    }

    public function textCyan(string $text): string
    {
        return $this->embed(
            "\e[36m",
            $text,
            "\e[0m"
        );
    }

    public function textWhite(string $text): string
    {
        return $this->embed(
            "\e[37m",
            $text,
            "\e[0m"
        );
    }



    public function backgroundBlack(string $text): string
    {
        return $this->embed(
            "\e[40m",
            $text,
            "\e[0m"
        );
    }

    public function backgroundRed(string $text): string
    {
        return $this->embed(
            "\e[41m",
            $text,
            "\e[0m"
        );
    }

    public function backgroundGreen(string $text): string
    {
        return $this->embed(
            "\e[42m",
            $text,
            "\e[0m"
        );
    }

    public function backgroundYellow(string $text): string
    {
        return $this->embed(
            "\e[43m",
            $text,
            "\e[0m"
        );
    }

    public function backgroundBlue(string $text): string
    {
        return $this->embed(
            "\e[44m",
            $text,
            "\e[0m"
        );
    }

    public function backgroundMagenta(string $text): string
    {
        return $this->embed(
            "\e[45m",
            $text,
            "\e[0m"
        );
    }

    public function backgroundCyan(string $text): string
    {
        return $this->embed(
            "\e[46m",
            $text,
            "\e[0m"
        );
    }

    public function backgroundWhite(string $text): string
    {
        return $this->embed(
            "\e[47m",
            $text,
            "\e[0m"
        );
    }



    public function reset(): string
    {
        return "\e[0m";
    }



    protected function embed(string $startCode, string $text, string $endCode): string
    {
        return $startCode . str_replace("\e[0m", "\e[0m" . $startCode, $text) . $endCode;
    }
}
