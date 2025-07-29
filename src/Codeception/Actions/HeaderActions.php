<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Http\HeadersInterface;
use Centum\Interfaces\Http\ResponseInterface;
use PHPUnit\Framework\Assert;

/**
 * Header Actions
 */
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



    /**
     * @param non-empty-string $name
     */
    public function grabHeaderValue(string $name): ?string
    {
        $headers = $this->grabHeaders();

        if (!$headers->has($name)) {
            return null;
        }

        $header = $headers->get($name);

        return $header->getValue();
    }



    /**
     * Check that a Header exists.
     *
     * @param non-empty-string $name
     */
    public function seeHeader(string $name): void
    {
        $headers = $this->grabHeaders();

        Assert::assertTrue(
            $headers->has($name),
            "Failed to see header."
        );
    }

    /**
     * Check that a Header does not exist.
     *
     * @param non-empty-string $name
     */
    public function dontSeeHeader(string $name): void
    {
        $headers = $this->grabHeaders();

        Assert::assertFalse(
            $headers->has($name),
            "Failed to not see header."
        );
    }



    /**
     * @param non-empty-string $name
     */
    public function seeHeaderValueIs(string $name, string $expectedValue): void
    {
        $headerValue = $this->grabHeaderValue($name);

        Assert::assertEquals(
            $expectedValue,
            $headerValue
        );
    }

    /**
     * @param non-empty-string $name
     */
    public function dontSeeHeaderValueIs(string $name, string $expectedValue): void
    {
        $headerValue = $this->grabHeaderValue($name);

        Assert::assertNotEquals(
            $expectedValue,
            $headerValue
        );
    }
}
