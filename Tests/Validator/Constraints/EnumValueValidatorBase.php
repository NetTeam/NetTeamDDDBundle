<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Validator\Constraints;

/**
 * Klasa bazowa dla testów EnumValue i NotNullEnumValue
 *
 * @author Krzysztof Menżyk <krzysztof.menzyk@netteam.pl>
 */
abstract class EnumValueValidatorBase extends \PHPUnit_Framework_TestCase
{
    protected $validator;
    protected $context;

    abstract protected function getConstraint($options = null);

    /**
     * @expectedException Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testUnexpectedType()
    {
        $this->validator->validate(new \stdClass, $this->getConstraint());
    }

    public function testValidValue()
    {
        $this->assertTrue($this->validator->validate(new TestEnum(TestEnum::ONE), $this->getConstraint()));
    }

    public function testInvalidValue()
    {
        $this->assertFalse($this->validator->validate(new TestEnum(-100, false), $this->getConstraint()));
    }

    public function testMessageIsSet()
    {
        $constraint = $this->getConstraint(array(
            'message' => 'myMessage'
        ));

        $this->context->expects($this->once())
            ->method('addViolation')
            ->with('myMessage');

        $this->assertFalse($this->validator->validate(new TestEnum(-100, false), $constraint));
    }
}
