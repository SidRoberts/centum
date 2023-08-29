<?php

namespace Tests\Unit\Forms;

use Centum\Filter\String\ToUpper;
use Centum\Forms\Field;
use Centum\Validator\Callback;
use Centum\Validator\NotEmpty;
use Centum\Validator\RegularExpression;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Exception;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Forms\Field
 */
class FieldCest
{
    public function testGetters(UnitTester $I): void
    {
        $field = new Field("thisIsTheName");

        $I->assertEquals(
            "thisIsTheName",
            $field->getName()
        );

        $I->assertEquals(
            [],
            $field->getFilters()
        );

        $I->assertEquals(
            [],
            $field->getValidators()
        );

        $I->assertEquals(
            [],
            $field->getMessages(
                []
            )
        );
    }

    public function testFilter(UnitTester $I): void
    {
        $field = new Field("thisIsTheName");



        $toUpperFilter = new ToUpper();

        $field->addFilter($toUpperFilter);




        $regularExpressionValidator = new RegularExpression(
            "/^[A-Z]+$/"
        );

        $field->addValidator($regularExpressionValidator);



        $I->assertEquals(
            [
                $toUpperFilter,
            ],
            $field->getFilters()
        );



        $I->assertEquals(
            [
                $regularExpressionValidator,
            ],
            $field->getValidators()
        );



        $I->assertTrue(
            $field->isValid("thisIsValid")
        );

        $I->assertEquals(
            [],
            $field->getMessages("thisIsValid")
        );



        $I->assertFalse(
            $field->isValid("This is not valid.")
        );

        $I->assertEquals(
            [
                "Value does not match '/^[A-Z]+$/'.",
            ],
            $field->getMessages("This is not valid.")
        );



        $I->assertFalse(
            $field->isValid("")
        );

        $I->assertEquals(
            [
                "Value does not match '/^[A-Z]+$/'.",
            ],
            $field->getMessages("")
        );
    }



    #[DataProvider("providerValidator")]
    public function testValidator(UnitTester $I, Example $example): void
    {
        $field = new Field("thisIsTheName");



        $notEmptyValidator = new NotEmpty();

        $field->addValidator($notEmptyValidator);



        $I->assertEquals(
            [
                $notEmptyValidator,
            ],
            $field->getValidators()
        );



        /** @var string */
        $value = $example["value"];

        /** @var bool */
        $isValid = $example["isValid"];

        $I->assertEquals(
            $isValid,
            $field->isValid($value)
        );

        /** @var array */
        $messages = $example["messages"];

        $I->assertEquals(
            $messages,
            $field->getMessages($value)
        );
    }

    protected function providerValidator(): array
    {
        return [
            [
                "value"    => "This is not empty.",
                "isValid"  => true,
                "messages" => [],
            ],

            [
                "value"    => "",
                "isValid"  => false,
                "messages" => [
                    "Value is required and can't be empty.",
                ],
            ],

            [
                "value"    => "This is not empty.",
                "isValid"  => true,
                "messages" => [],
            ],
        ];
    }



    public function testValidatorThrowsException(UnitTester $I): void
    {
        $field = new Field("thisIsTheName");



        $notStringValidator = new Callback(
            function (mixed $value): array {
                if (is_string($value)) {
                    throw new Exception("Value cannot be a string.");
                }

                return [];
            }
        );

        $field->addValidator($notStringValidator);



        $I->assertEquals(
            [
                "Value cannot be a string.",
            ],
            $field->getMessages("Just a random string.")
        );
    }
}
