<?php

namespace Centum\Codeception\Actions;

use PHPUnit\Framework\Assert;

trait JsonActions
{
    abstract public function grabResponseContent(): string;



    public function seeResponseIsJson(): void
    {
        $content = $this->grabResponseContent();

        $isJson = (json_decode($content) !== null);

        Assert::assertTrue($isJson);
    }
}
