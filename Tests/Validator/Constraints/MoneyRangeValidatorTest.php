<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Validator\Constraints;

use NetTeam\Bundle\DDDBundle\Validator\Constraints\MoneyRange as MoneyRangeConstraint;
use NetTeam\Bundle\DDDBundle\Validator\Constraints\MoneyRangeValidator;
use NetTeam\DDD\ValueObject\MoneyRange;
use NetTeam\DDD\ValueObject\Money;

/**
 * @group Unit
 */
class MoneyRangeValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $validator;
    private $context;

    protected function setUp()
    {
        $this->validator = new MoneyRangeValidator();
        $this->context = $this->getMock('Symfony\Component\Validator\ExecutionContext', array(), array(), '', false);
        $this->validator->initialize($this->context);
    }

    protected function tearDown()
    {
        $this->validator = null;
        $this->context = null;
    }

    /**
     * @expectedException \Symfony\Component\Validator\Exception\ValidatorException
     */
    public function testIfUnexpectedValueTypeGiventThenThrowException()
    {
        $range = new \stdClass();

        $this->context->expects($this->never())->method('addViolation');
        $this->validator->validate($range, new MoneyRangeConstraint());
    }

    public function testIfRangeWithLowerLimitGreaterThanUpperThenValidationFail()
    {
        $range = MoneyRange::USD(100.0, 50.0);

        $this->context->expects($this->once())->method('addViolation');
        $this->assertFalse($this->validator->validate($range, new MoneyRangeConstraint()));
    }

    public function testIfRangeWithDifferentLimitsCurrenciesThenValidationFail()
    {
        $range = new MoneyRange(Money::PLN(100.0), Money::USD(100.0));

        $this->context->expects($this->once())->method('addViolation');
        $this->assertFalse($this->validator->validate($range, new MoneyRangeConstraint()));
    }

    public function testIfCorrectRangeThenValidationSuccess()
    {
        $range = MoneyRange::PLN(100.0, 1000.0);

        $this->context->expects($this->never())->method('addViolation');
        $this->assertTrue($this->validator->validate($range, new MoneyRangeConstraint()));
    }

    public function testIfRangeWithNullLimitsThenValidationSuccess()
    {
        $range = new MoneyRange(null, null);

        $this->context->expects($this->never())->method('addViolation');
        $this->assertTrue($this->validator->validate($range, new MoneyRangeConstraint()));
    }

    /**
     * @expectedException \Symfony\Component\Validator\Exception\ValidatorException
     */
    public function testIfNotMoneyLimitsThenThrowException()
    {
        $range = new MoneyRange(100.0, 100.0);

        $this->context->expects($this->never())->method('addViolation');
        $this->validator->validate($range, new MoneyRangeConstraint());
    }
}
