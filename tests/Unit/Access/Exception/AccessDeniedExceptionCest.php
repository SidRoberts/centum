<?php

namespace Tests\Unit\Access\Exception;

use Centum\Access\Exception\AccessDeniedException;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Access\Exception\AccessDeniedException
 */
class AccessDeniedExceptionCest
{
    public function test(UnitTester $I): void
    {
        $user         = "sidroberts";
        $activityName = "purge-database";

        $exception = new AccessDeniedException($user, $activityName);

        $I->assertEquals(
            $user,
            $exception->getUser()
        );

        $I->assertEquals(
            $activityName,
            $exception->getActivityName()
        );
    }
}
