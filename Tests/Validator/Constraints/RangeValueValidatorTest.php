<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Validator\Constraints;

use NetTeam\Bundle\DDDBundle\Validator\Constraints\RangeValue;
use NetTeam\Bundle\DDDBundle\Validator\Constraints\RangeValueValidator;
use NetTeam\DDD\ValueObject\Range;

/**
 * @author Krzysztof Menżyk <krzysztof.menzyk@netteam.pl>
 *
 * @group Unit
 */
class RangeValueConstraintValidatorTest extends \PHPUnit_Framework_TestCase
{
    protected $validator;
    protected $context;

    protected function setUp()
    {
        $this->validator = new RangeValueValidator();
        $this->context = $this->getMock('Symfony\Component\Validator\ExecutionContext', array(), array(), '', false);
        $this->validator->initialize($this->context);
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testUnexpectedType()
    {
        $this->context->expects($this->never())->method('addViolation');
        $this->validator->validate(new \stdClass, new RangeValue());
    }

    public function testValidValue()
    {
        $this->context->expects($this->never())->method('addViolation');
        $this->assertTrue($this->validator->validate(new Range(1, 10), new RangeValue()));
    }

    public function testInvalidValue()
    {
        $this->context->expects($this->once())->method('addViolation');
        $this->assertFalse($this->validator->validate(new Range(100, 1), new RangeValue()));
    }

    public function testMessageIsSet()
    {
        $constraint = new RangeValue(array(
            'message' => 'myMessage'
        ));

        $this->context->expects($this->once())->method('addViolation')->with('myMessage');
        $this->assertFalse($this->validator->validate(new Range(100, 1), $constraint));
    }

    public function testConstraintGetTargets()
    {
        $constraint = new RangeValue();

        $this->assertEquals('class', $constraint->getTargets());
    }
}
