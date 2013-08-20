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

    protected function setUp()
    {
        $this->validator = new RangeLimitsValidator();
    }

    protected function tearDown()
    {
        $this->validator = null;
    }

    public function testIfLowerLimitIsGreaterThanUpperLimitAndLimitsImplementComparableThenValidationFail()
    {
        $range = new Range(new ComparableLimit(10), new ComparableLimit(0));

        $this->assertFalse($this->validator->isValid($range, new RangeLimits()));
    }

    public function testIfLowerLimitIsGreaterThanUpperLimitAndLimitsDoNotImplementComparableThenValidationFail()
    {
        $range = new Range(10, 0);

        $this->assertFalse($this->validator->isValid($range, new RangeLimits()));
    }

    public function testIfLimitsAreEqualAndLimitsImplementComparableThenValidationSuccess()
    {
        $range = new Range(new ComparableLimit(10), new ComparableLimit(10));

        $this->assertTrue($this->validator->isValid($range, new RangeLimits()));
    }

    public function testIfLimitsAreEqualAndLimitsDoNotImplementComparableThenValidationSuccess()
    {
        $range = new Range(10, 10);

        $this->assertTrue($this->validator->isValid($range, new RangeLimits()));
    }

    public function testIfLowerLimitIsLowerThanUpperLimitAndLimitsImplementComparableThenValidationSuccess()
    {
        $range = new Range(new ComparableLimit(0), new ComparableLimit(10));

        $this->assertTrue($this->validator->isValid($range, new RangeLimits()));
    }

    public function testIfLowerLimitIsLowerThanUpperLimitAndLimitsDoNotImplementComparableThenValidationSuccess()
    {
        $range = new Range(0, 10);

        $this->assertTrue($this->validator->isValid($range, new RangeLimits()));
    }

    public function testIfAnyOfLimitsIsNullThenValidationSuccess()
    {
        $leftOpenRange = new Range(null, 1);
        $rightOpenRange = new Range(1, null);
        $openRange = new Range(null, null);

        $this->assertTrue($this->validator->isValid($leftOpenRange, new RangeLimits()));
        $this->assertTrue($this->validator->isValid($rightOpenRange, new RangeLimits()));
        $this->assertTrue($this->validator->isValid($openRange, new RangeLimits()));
    }

    /**
     * @expectedException \Symfony\Component\Validator\Exception\ValidatorException
     */
    public function testIfValueIsNotInstanceOfRangeThenThrowException()
    {
        $this->validator->isValid(new \stdClass(), new RangeLimits());
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
