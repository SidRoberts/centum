<?php

namespace Tests\Unit\Clock;

use Centum\Clock\MockClock;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Clock\MockClock
 */
final class MockClockCest
{
    public function testNow(UnitTester $I): void
    {
        $clock = new MockClock("2023-01-13 11:23:00");

        $time1 = $clock->now();

        sleep(1);

        $time2 = $clock->now();

        $I->assertEquals(
            $time1,
            $time2
        );
    }

    public function testSleep(UnitTester $I): void
    {
        $clock = new MockClock();

        $time1 = $clock->now();

        $clock->sleep(3);

        $time2 = $clock->now();

        $I->assertEquals(
            $time1->modify("+3 seconds"),
            $time2
        );
    }

    public function testModify(UnitTester $I): void
    {
        $clock = new MockClock();

        $time1 = $clock->now();

        $clock->modify("+5 minutes");

        $time2 = $clock->now();

        $I->assertEquals(
            $time1->modify("+5 minutes"),
            $time2
        );
    }

    public function testStartStop(UnitTester $I): void
    {
        $clock = new MockClock();

        $time1 = $clock->now();

        $clock->start();

        sleep(1);

        $clock->stop();

        $time2 = $clock->now();

        $I->assertNotEquals(
            $time1,
            $time2
        );
    }
}
