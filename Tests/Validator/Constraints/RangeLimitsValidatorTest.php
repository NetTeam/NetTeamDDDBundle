<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Validator\Constraints;

use NetTeam\Bundle\DDDBundle\Validator\Constraints\RangeLimits;
use NetTeam\Bundle\DDDBundle\Validator\Constraints\RangeLimitsValidator;
use NetTeam\DDD\ValueObject\Range;
use Doctrine\Common\Comparable;

/**
 * @author Paweł A. Wacławczyk <p.a.waclawczyk@gmail.com>
 *
 * @group Unit
 */
class RangeLimitsValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $validator;
    private $context;

    protected function setUp()
    {
        $this->validator = new RangeLimitsValidator();
        $this->context = $this->getMock('Symfony\Component\Validator\ExecutionContext', array(), array(), '', false);
        $this->validator->initialize($this->context);
    }

    protected function tearDown()
    {
        $this->validator = null;
        $this->context = null;
    }

    public function testIfLowerLimitIsGreaterThanUpperLimitAndLimitsImplementComparableThenValidationFail()
    {
        $range = new Range(new ComparableLimit(10), new ComparableLimit(0));

        $this->context->expects($this->once())->method('addViolation');
        $this->assertFalse($this->validator->validate($range, new RangeLimits()));
    }

    public function testIfLowerLimitIsGreaterThanUpperLimitAndLimitsDoNotImplementComparableThenValidationFail()
    {
        $range = new Range(10, 0);

        $this->context->expects($this->once())->method('addViolation');
        $this->assertFalse($this->validator->validate($range, new RangeLimits()));
    }

    public function testIfLimitsAreEqualAndLimitsImplementComparableThenValidationSuccess()
    {
        $range = new Range(new ComparableLimit(10), new ComparableLimit(10));

        $this->context->expects($this->never())->method('addViolation');
        $this->assertTrue($this->validator->validate($range, new RangeLimits()));
    }

    public function testIfLimitsAreEqualAndLimitsDoNotImplementComparableThenValidationSuccess()
    {
        $range = new Range(10, 10);

        $this->context->expects($this->never())->method('addViolation');
        $this->assertTrue($this->validator->validate($range, new RangeLimits()));
    }

    public function testIfLowerLimitIsLowerThanUpperLimitAndLimitsImplementComparableThenValidationSuccess()
    {
        $range = new Range(new ComparableLimit(0), new ComparableLimit(10));

        $this->context->expects($this->never())->method('addViolation');
        $this->assertTrue($this->validator->validate($range, new RangeLimits()));
    }

    public function testIfLowerLimitIsLowerThanUpperLimitAndLimitsDoNotImplementComparableThenValidationSuccess()
    {
        $range = new Range(0, 10);

        $this->context->expects($this->never())->method('addViolation');
        $this->assertTrue($this->validator->validate($range, new RangeLimits()));
    }

    public function testIfAnyOfLimitsIsNullThenValidationSuccess()
    {
        $leftOpenRange = new Range(null, 1);
        $rightOpenRange = new Range(1, null);
        $openRange = new Range(null, null);

        $this->context->expects($this->never())->method('addViolation');
        $this->assertTrue($this->validator->validate($leftOpenRange, new RangeLimits()));
        $this->assertTrue($this->validator->validate($rightOpenRange, new RangeLimits()));
        $this->assertTrue($this->validator->validate($openRange, new RangeLimits()));
    }

    /**
     * @expectedException \Symfony\Component\Validator\Exception\ValidatorException
     */
    public function testIfValueIsNotInstanceOfRangeThenThrowException()
    {
        $this->context->expects($this->never())->method('addViolation');
        $this->validator->validate(new \stdClass(), new RangeLimits());
    }
}

class ComparableLimit implements Comparable
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function compareTo($other)
    {
        if ($this->value < $other->value) {
            return -1;
        } elseif ($this->value == $other->value) {
            return 0;
        } else {
            return 1;
        }
    }
}
