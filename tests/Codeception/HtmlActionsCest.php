<?php

namespace Tests\Codeception;

use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Tests\Support\CodeceptionTester;
use Tests\Support\Controllers\HtmlController;

/**
 * @covers \Centum\Codeception\Actions\HtmlActions
 */
class HtmlActionsCest
{
    public function testGrabTextContent(CodeceptionTester $I): void
    {
        $I->markTestIncomplete();
    }



    public function testSubmitForm(CodeceptionTester $I): void
    {
        $I->markTestIncomplete();
    }



    public function testSee(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/html", HtmlController::class, "index");



        $I->amOnPage("/html");

        $I->see("This is a quote.");
    }

    public function testDontSee(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/html", HtmlController::class, "index");



        $I->amOnPage("/html");

        // We, as a user, don't see this because this is in the source.
        $I->dontSee("<blockquote>");
    }

    public function testSeeInSource(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/html", HtmlController::class, "index");



        $I->amOnPage("/html");

        $I->seeInSource("<blockquote>");
    }

    public function testDontSeeInSource(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/html", HtmlController::class, "index");



        $I->amOnPage("/html");

        $I->dontSeeInSource("<fieldset>");
    }

    public function testSeeInPageTitle(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/html", HtmlController::class, "index");



        $I->amOnPage("/html");

        $I->seeInPageTitle("hello");
    }

    public function testDontSeeInPageTitle(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/html", HtmlController::class, "index");



        $I->amOnPage("/html");

        $I->dontSeeInPageTitle("bye");
    }



    #[DataProvider("providerGrabPageTitle")]
    public function testGrabPageTitle(CodeceptionTester $I, Example $example): void
    {
        $group = $I->makeRouterGroup();

        /** @var non-empty-string */
        $method = $example["method"];

        $group->get("/html", HtmlController::class, $method);



        $I->amOnPage("/html");

        $title = $I->grabPageTitle();

        $I->assertEquals(
            $example["expected"],
            $title
        );
    }

    protected function providerGrabPageTitle(): array
    {
        return [
            [
                "method"   => "index",
                "expected" => "hello",
            ],

            [
                "method"   => "withoutTitle",
                "expected" => "",
            ],

            [
                "method"   => "withoutHtml",
                "expected" => "",
            ],
        ];
    }



    public function testSeeElement(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/html", HtmlController::class, "index");



        $I->amOnPage("/html");

        $I->seeElement("#logo");
    }

    public function testDontSeeElement(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/html", HtmlController::class, "index");



        $I->amOnPage("/html");

        $I->dontSeeElement("#sidebar");
    }



    public function testGrabElement(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/html", HtmlController::class, "index");



        $I->amOnPage("/html");

        $element = $I->grabElement("#logo");

        $I->assertEquals(
            "img",
            $element?->nodeName()
        );
    }

    public function testGrabElementWithoutHtml(CodeceptionTester $I): void
    {
        $group = $I->makeRouterGroup();

        $group->get("/html", HtmlController::class, "withoutHtml");



        $I->amOnPage("/html");

        $element = $I->grabElement("#logo");

        $I->assertNull(
            $element
        );
    }
}
