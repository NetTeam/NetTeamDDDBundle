<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Validator\Constraints;

use NetTeam\Bundle\DDDBundle\Validator\Constraints\MoneyRangeValue as MoneyRangeConstraint;
use NetTeam\Bundle\DDDBundle\Validator\Constraints\MoneyRangeValueValidator;
use NetTeam\DDD\ValueObject\MoneyRange;
use NetTeam\DDD\ValueObject\Money;

/**
 * @group Unit
 */
class MoneyRangeValueValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $validator;

    protected function setUp()
    {
        $this->validator = new MoneyRangeValueValidator();
    }

    protected function tearDown()
    {
        $this->validator = null;
    }

    /**
     * @expectedException \Symfony\Component\Validator\Exception\ValidatorException
     */
    public function testIfUnexpectedValueTypeGiventThenThrowException()
    {
        $range = new \stdClass();

        $this->validator->isValid($range, new MoneyRangeConstraint());
    }

    public function testIfRangeWithLowerLimitGreaterThanUpperThenValidationFail()
    {
        $range = MoneyRange::USD(100.0, 50.0);

        $this->assertFalse($this->validator->isValid($range, new MoneyRangeConstraint()));
    }

    public function testIfRangeWithDifferentLimitsCurrenciesThenValidationFail()
    {
        $range = new MoneyRange(Money::PLN(100.0), Money::USD(100.0));

        $this->assertFalse($this->validator->isValid($range, new MoneyRangeConstraint()));
    }

    public function testIfCorrectRangeThenValidationSuccess()
    {
        $range = MoneyRange::PLN(100.0, 1000.0);

        $this->assertTrue($this->validator->isValid($range, new MoneyRangeConstraint()));
    }

    public function testIfRangeWithNullLimitsThenValidationSuccess()
    {
        $range = new MoneyRange(null, null);

        $this->assertTrue($this->validator->isValid($range, new MoneyRangeConstraint()));
    }

    /**
     * @expectedException \Symfony\Component\Validator\Exception\ValidatorException
     */
    public function testIfNotMoneyLimitsThenThrowException()
    {
        $range = new MoneyRange(100.0, 100.0);

        $this->validator->isValid($range, new MoneyRangeConstraint());
    }
}
