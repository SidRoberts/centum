<?php

namespace Tests\Codeception;

use Tests\Support\CodeceptionTester;
use Tests\Support\Controllers\JsonController;

class JsonActionsCest
{
    public function testSeeResponseIsJson(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/json", JsonController::class, "index");



        $I->amOnPage("/json");

        $I->seeResponseIsJson();
    }
}
