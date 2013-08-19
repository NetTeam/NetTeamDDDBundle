<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Validator\Constraints;

use NetTeam\Bundle\DDDBundle\Validator\Constraints\DateRangeValue as DateRangeConstraint;
use NetTeam\Bundle\DDDBundle\Validator\Constraints\DateRangeValueValidator;
use NetTeam\DDD\ValueObject\DateRange;

/**
 * @author Paweł A. Wacławczyk <p.a.waclawczyk@gmail.com>
 *
 * @group Unit
 */
class DateRangeValueValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $validator;

    protected function setUp()
    {
        $this->validator = new DateRangeValueValidator();
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

        $this->validator->isValid($range, new DateRangeConstraint());
    }

    public function testIfRangeWithLowerLimitGreaterThanUpperThenValidationFail()
    {
        $range = new DateRange(new \DateTime('2013-12-31'), new \DateTime('2013-01-01'));

        $this->assertFalse($this->validator->isValid($range, new DateRangeConstraint()));
    }

    public function testIfCorrectRangeThenValidationSuccess()
    {
        $range = new DateRange(new \DateTime('2013-01-01'), new \DateTime('2013-12-31'));

        $this->assertTrue($this->validator->isValid($range, new DateRangeConstraint()));
    }

    public function testIfRangeWithNullLimitsThenValidationSuccess()
    {
        $range = new DateRange(null, null);

        $this->assertTrue($this->validator->isValid($range, new DateRangeConstraint()));
    }

    /**
     * @expectedException \Symfony\Component\Validator\Exception\ValidatorException
     */
    public function testIfNotDateTimeLimitsThenThrowException()
    {
        $range = new DateRange(100.0, 100.0);

        $this->validator->isValid($range, new DateRangeConstraint());
    }
}
