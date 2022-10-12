<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Http\HeadersInterface;
use Centum\Interfaces\Http\ResponseInterface;
use PHPUnit\Framework\Assert;

trait HeaderActions
{
    abstract public function grabResponse(): ResponseInterface;



    public function grabHeaders(): HeadersInterface
    {
        $response = $this->grabResponse();

        $headers = $response->getHeaders();

        return $headers;
    }



    public function grabHeaderValue(string $name): string|null
    {
        $response = $this->grabResponse();

        $headers = $response->getHeaders();

        if (!$headers->has($name)) {
            return null;
        }

        $header = $headers->get($name);

        return $header->getValue();
    }



    public function seeHeader(string $name): void
    {
        $response = $this->grabResponse();

        $headers = $response->getHeaders();

        Assert::assertTrue(
            $headers->has($name),
            "Failed to see header."
        );
    }

    public function dontSeeHeader(string $name): void
    {
        $response = $this->grabResponse();

        $headers = $response->getHeaders();

        Assert::assertFalse(
            $headers->has($name),
            "Failed to not see header."
        );
    }



    public function seeHeaderValueIs(string $name, string $value = null): void
    {
        $headerValue = $this->grabHeaderValue($name);

        Assert::assertEquals(
            $value,
            $headerValue
        );
    }

    public function dontSeeHeaderValueIs(string $name, string $value = null): void
    {
        $headerValue = $this->grabHeaderValue($name);

        Assert::assertNotEquals(
            $value,
            $headerValue
        );
    }
}
