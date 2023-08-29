<?php

namespace Tests\Unit\Clock;

use Centum\Clock\Clock;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Clock\Clock
 */
class ClockCest
{
    public function test(UnitTester $I): void
    {
        $clock = new Clock("2023-01-13 11:23:00");

        $time1 = $clock->now();

        sleep(1);

        $time2 = $clock->now();

        $I->assertEquals(
            $time1,
            $time2
        );
    }
}
