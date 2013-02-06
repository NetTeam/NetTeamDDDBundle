<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Validator\Constraints;

use NetTeam\Bundle\DDDBundle\Validator\Constraints\EnumValueValidator;
use NetTeam\Bundle\DDDBundle\Validator\Constraints\EnumValue;
use NetTeam\DDD\Enum;

/**
 * @author Krzysztof Menżyk <krzysztof.menzyk@netteam.pl>
 *
 * @group Unit
 */
class EnumValueValidatorTest extends \PHPUnit_Framework_TestCase
{
    protected $validator;
    protected $context;

    protected function setUp()
    {
        $this->validator = new EnumValueValidator();
        $this->context = $this->getMock('Symfony\Component\Validator\ExecutionContext', array(), array(), '', false);
        $this->validator->initialize($this->context);
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testUnexpectedType()
    {
        $this->context->expects($this->never())->method('addViolation');
        $this->validator->validate(new \stdClass, new EnumValue());
    }

    public function testValidValue()
    {
        $this->context->expects($this->never())->method('addViolation');
        $this->assertTrue($this->validator->validate(new TestEnum(TestEnum::ONE), new EnumValue()));
    }

    public function testInvalidValue()
    {
        $this->context->expects($this->once())->method('addViolation');
        $this->assertFalse($this->validator->validate(new TestEnum(-100, false), new EnumValue()));
    }

    public function testMessageIsSet()
    {
        $constraint = new EnumValue(array(
            'message' => 'myMessage'
        ));

        $this->context->expects($this->once())
            ->method('addViolation')
            ->with('myMessage');

        $this->assertFalse($this->validator->validate(new TestEnum(-100, false), $constraint));
    }

    public function testConstraintGetTargets()
    {
        $constraint = new EnumValue();

        $this->assertEquals('class', $constraint->getTargets());
    }
}

class TestEnum extends Enum
{
    const ONE = 1;
    const TWO = 2;
}
