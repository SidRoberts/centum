<?php

namespace Tests\Forms;

use Centum\Filter\String\ToUpper;
use Centum\Forms\Field;
use Centum\Validator\NotEmpty;
use Centum\Validator\RegularExpression;
use Tests\UnitTester;

class FieldCest
{
    public function getters(UnitTester $I): void
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

    public function testValidator(UnitTester $I): void
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



        $I->assertTrue(
            $field->isValid("This is not empty.")
        );

        $I->assertEquals(
            [],
            $field->getMessages("This is not empty.")
        );



        $I->assertFalse(
            $field->isValid("")
        );

        $I->assertEquals(
            [
                "Value is required and can't be empty.",
            ],
            $field->getMessages("")
        );



        $I->assertTrue(
            $field->isValid("This is not empty.")
        );

        $I->assertEquals(
            [],
            $field->getMessages("This is not empty.")
        );
    }
}
