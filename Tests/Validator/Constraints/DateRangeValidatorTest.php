<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Validator\Constraints;

use NetTeam\Bundle\DDDBundle\Validator\Constraints\DateRange as DateRangeConstraint;
use NetTeam\Bundle\DDDBundle\Validator\Constraints\DateRangeValidator;
use NetTeam\DDD\ValueObject\DateRange;

/**
 * @author Paweł A. Wacławczyk <p.a.waclawczyk@gmail.com>
 *
 * @group Unit
 */
class DateRangeValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $validator;
    private $context;

    protected function setUp()
    {
        $this->validator = new DateRangeValidator();
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

        $this->validator->validate($range, new DateRangeConstraint());
    }

    public function testIfRangeWithLowerLimitGreaterThanUpperThenValidationFail()
    {
        $range = new DateRange(new \DateTime('2013-12-31'), new \DateTime('2013-01-01'));

        $this->assertFalse($this->validator->validate($range, new DateRangeConstraint()));
    }

    public function testIfCorrectRangeThenValidationSuccess()
    {
        $range = new DateRange(new \DateTime('2013-01-01'), new \DateTime('2013-12-31'));

        $this->assertTrue($this->validator->validate($range, new DateRangeConstraint()));
    }

    public function testIfRangeWithNullLimitsThenValidationSuccess()
    {
        $range = new DateRange(null, null);

        $this->assertTrue($this->validator->validate($range, new DateRangeConstraint()));
    }

    /**
     * @expectedException \Symfony\Component\Validator\Exception\ValidatorException
     */
    public function testIfNotDateTimeLimitsThenThrowException()
    {
        $range = new DateRange(100.0, 100.0);

        $this->validator->validate($range, new DateRangeConstraint());
    }
}
