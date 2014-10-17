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

    abstract protected function getConstraint($options = null);

    /**
     * @expectedException Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testUnexpectedType()
    {
        $this->validator->isValid(new \stdClass(), $this->getConstraint());
    }

    public function testValidValue()
    {
        $this->assertTrue($this->validator->isValid(new TestEnum(TestEnum::ONE), $this->getConstraint()));
    }

    public function testInvalidValue()
    {
        $this->assertFalse($this->validator->isValid(new TestEnum(-100, false), $this->getConstraint()));
    }

    public function testMessageIsSet()
    {
        $constraint = $this->getConstraint(array(
            'message' => 'myMessage'
        ));

        $this->assertFalse($this->validator->isValid(new TestEnum(-100, false), $constraint));
        $this->assertEquals($this->validator->getMessageTemplate(), 'myMessage');
    }
}
