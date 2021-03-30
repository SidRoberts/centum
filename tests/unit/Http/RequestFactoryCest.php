<?php

namespace Tests\Http;

use Centum\Http\RequestFactory;
use Tests\UnitTester;

class RequestFactoryCest
{
    public function testCreateFromGlobals(UnitTester $I)
    {
        $_GET["foo"] = "bar";

        $_SERVER["REQUEST_METHOD"] = "GET";

        $request = RequestFactory::createFromGlobals();

        $I->assertEquals("bar", $request->getParameters()["foo"], "::fromGlobals() uses values from GET");

        unset($_GET["foo1"]);



        $_POST["foo"] = "bar";

        $_SERVER["REQUEST_METHOD"] = "POST";

        $request = RequestFactory::createFromGlobals();

        $I->assertEquals("bar", $request->getParameters()["foo"], "::fromGlobals() uses values from POST");

        unset($_POST["foo1"]);
    }
}
