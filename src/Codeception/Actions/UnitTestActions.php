<?php

namespace Centum\Codeception\Actions;

use PHPUnit\Framework\Assert;
use ReflectionClass;
use Throwable;

/**
 * Unit Test Actions
 */
trait UnitTestActions
{
    public function grabEchoContent(callable $callable): string
    {
        ob_start();

        try {
            call_user_func($callable);
        } catch (Throwable $throwable) {
            ob_end_clean();

            throw $throwable;
        }

        return ob_get_clean();
    }

    public function expectEcho(string $expected, callable $callable): void
    {
        $actual = $this->grabEchoContent($callable);

        Assert::assertEquals(
            $expected,
            $actual,
            "Failed asserting callable echoes an expected string."
        );
    }



    /**
     * @param non-empty-string $name
     */
    public function getPropertyValue(object $object, string $name): mixed
    {
        $reflection = new ReflectionClass($object);

        $property = $reflection->getProperty($name);

        return $property->getValue($object);
    }
}
