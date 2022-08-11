<?php

namespace Tests\Unit\Http;

use Centum\Http\Status;
use Codeception\Example;
use Tests\UnitTester;
use ValueError;

class StatusCest
{
    public function test(UnitTester $I): void
    {
        $status = Status::NOT_FOUND;

        $I->assertEquals(
            404,
            $status->getCode()
        );

        $I->assertEquals(
            "Not Found",
            $status->getText()
        );
    }

    public function testInvalidCode(UnitTester $I): void
    {
        $I->expectThrowable(
            ValueError::class,
            function () {
                $status = Status::from(999);
            }
        );
    }

    /**
     * @dataProvider providerStatusTexts
     */
    public function testGetString(UnitTester $I, Example $example): void
    {
        $status = Status::from($example[0]);

        $I->assertEquals(
            $example[1],
            $status->getText()
        );
    }

    protected function providerStatusTexts(): array
    {
        return [
            [100, "Continue"],
            [101, "Switching Protocols"],
            [102, "Processing"],
            [103, "Early Hints"],
            [200, "OK"],
            [201, "Created"],
            [202, "Accepted"],
            [203, "Non-Authoritative Information"],
            [204, "No Content"],
            [205, "Reset Content"],
            [206, "Partial Content"],
            [207, "Multi-Status"],
            [208, "Already Reported"],
            [226, "IM Used"],
            [300, "Multiple Choices"],
            [301, "Moved Permanently"],
            [302, "Found"],
            [303, "See Other"],
            [304, "Not Modified"],
            [305, "Use Proxy"],
            [307, "Temporary Redirect"],
            [308, "Permanent Redirect"],
            [400, "Bad Request"],
            [401, "Unauthorized"],
            [402, "Payment Required"],
            [403, "Forbidden"],
            [404, "Not Found"],
            [405, "Method Not Allowed"],
            [406, "Not Acceptable"],
            [407, "Proxy Authentication Required"],
            [408, "Request Timeout"],
            [409, "Conflict"],
            [410, "Gone"],
            [411, "Length Required"],
            [412, "Precondition Failed"],
            [413, "Payload Too Large"],
            [414, "URI Too Long"],
            [415, "Unsupported Media Type"],
            [416, "Range Not Satisfiable"],
            [417, "Expectation Failed"],
            [421, "Misdirected Request"],
            [422, "Unprocessable Entity"],
            [423, "Locked"],
            [424, "Failed Dependency"],
            [425, "Too Early"],
            [426, "Upgrade Required"],
            [428, "Precondition Required"],
            [429, "Too Many Requests"],
            [431, "Request Header Fields Too Large"],
            [451, "Unavailable For Legal Reasons"],
            [500, "Internal Server Error"],
            [501, "Not Implemented"],
            [502, "Bad Gateway"],
            [503, "Service Unavailable"],
            [504, "Gateway Timeout"],
            [505, "HTTP Version Not Supported"],
            [506, "Variant Also Negotiates"],
            [507, "Insufficient Storage"],
            [508, "Loop Detected"],
            [510, "Not Extended"],
            [511, "Network Authentication Required"],
        ];
    }

    public function testIsRedirect(UnitTester $I): void
    {
        $I->assertFalse(
            Status::OK->isRedirect()
        );

        $I->assertTrue(
            Status::FOUND->isRedirect()
        );
    }

    public function testGetHeaderString(UnitTester $I): void
    {
        $I->assertEquals(
            "HTTP/1.0 200 OK",
            Status::OK->getHeaderString()
        );

        $I->assertEquals(
            "HTTP/1.0 404 Not Found",
            Status::NOT_FOUND->getHeaderString()
        );
    }
}
