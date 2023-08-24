<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Http\HeadersInterface;
use Centum\Interfaces\Http\ResponseInterface;
use PHPUnit\Framework\Assert;

trait HeaderActions
{
    abstract public function grabResponse(): ResponseInterface;



    /**
     * Grab the HTTP Headers from the Container.
     */
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



    /**
     * Check that a Header exists.
     */
    public function seeHeader(string $name): void
    {
        $response = $this->grabResponse();

        $headers = $response->getHeaders();

        Assert::assertTrue(
            $headers->has($name),
            "Failed to see header."
        );
    }

    /**
     * Check that a Header does not exist.
     */
    public function dontSeeHeader(string $name): void
    {
        $response = $this->grabResponse();

        $headers = $response->getHeaders();

        Assert::assertFalse(
            $headers->has($name),
            "Failed to not see header."
        );
    }



    public function seeHeaderValueIs(string $name, string $expectedValue): void
    {
        $headerValue = $this->grabHeaderValue($name);

        Assert::assertEquals(
            $expectedValue,
            $headerValue
        );
    }

    public function dontSeeHeaderValueIs(string $name, string $expectedValue): void
    {
        $headerValue = $this->grabHeaderValue($name);

        Assert::assertNotEquals(
            $expectedValue,
            $headerValue
        );
    }
}
