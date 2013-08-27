<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Validator\Constraints;

use NetTeam\Bundle\DDDBundle\Validator\Constraints\PercentRange;
use NetTeam\Bundle\DDDBundle\Validator\Constraints\PercentRangeValidator;
use NetTeam\DDD\ValueObject\Percent;

/**
 * @author Piotr Walków <piotr.walkow@netteam.pl>
 *
 * @group Unit
 */
class PercentRangeValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $validator;
    private $context;

    protected function setUp()
    {
        $this->validator = new PercentRangeValidator();
        $this->context = \Mockery::mock('Symfony\Component\Validator\ExecutionContext');
        $this->validator->initialize($this->context);
    }

    protected function tearDown()
    {
        $this->validator = null;
        $this->context = null;
    }

    public function testIfValueIsNull()
    {
        $this->context->shouldReceive('addViolation')->never();

        $this->validator->validate(null, new PercentRange(array(
            'min' => 1,
        )));
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testIfValueIsNotPercent()
    {
        $percent = new \stdClass();

        $this->assertFalse($this->validator->validate($percent, new PercentRange(array(
            'min' => 0,
        ))));
    }

    public function testValid()
    {
        $percent = new Percent(12.34);

        $this->context->shouldReceive('addViolation')->never();

        $this->validator->validate($percent, new PercentRange(array(
            'min' => 0,
        )));
    }

}
