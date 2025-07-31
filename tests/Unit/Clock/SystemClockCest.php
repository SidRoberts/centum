<?php

namespace Tests\Unit\Clock;

use Centum\Clock\SystemClock;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Clock\SystemClock
 */
final class SystemClockCest
{
    public function testNow(UnitTester $I): void
    {
        $clock = new SystemClock();

        $time1 = $clock->now();

        sleep(1);

        $time2 = $clock->now();

        $I->assertNotEquals(
            $time1,
            $time2
        );
    }
}
