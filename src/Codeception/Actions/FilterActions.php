<?php

namespace Centum\Codeception\Actions;

use Centum\Interfaces\Filter\FilterInterface;
use PHPUnit\Framework\Assert;
use Throwable;

/**
 * Filter Actions
 */
trait FilterActions
{
    /**
     * @param Throwable|string $throwable
     */
    abstract public function expectThrowable($throwable, callable $callback): void;



    public function expectFilterOutput(FilterInterface $filter, mixed $input, mixed $output): void
    {
        /** @var mixed */
        $value = $filter->filter($input);

        Assert::assertEquals($output, $value);
    }

    public function expectFilterThrowable(Throwable $expectedThrowable, FilterInterface $filter, mixed $input): void
    {
        $this->expectThrowable(
            $expectedThrowable,
            function () use ($filter, $input): void {
                $filter->filter($input);
            }
        );
    }
}
