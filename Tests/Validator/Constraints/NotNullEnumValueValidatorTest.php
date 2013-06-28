<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Validator\Constraints;

use NetTeam\Bundle\DDDBundle\Validator\Constraints\NotNullEnumValueValidator;
use NetTeam\Bundle\DDDBundle\Validator\Constraints\NotNullEnumValue;

/**
 * @author Wojciech Muła <wojciech.mula@netteam.pl>
 *
 * @group Unit
 */
class NotNullEnumValueValidatorTest extends EnumValueValidatorBase
{
    protected function setUp()
    {
        $this->validator = new NotNullEnumValueValidator();
        $this->context = $this->getMock('Symfony\Component\Validator\ExecutionContext', array(), array(), '', false);
        $this->validator->initialize($this->context);
    }

    protected function getConstraint($options = null)
    {
        return new NotNullEnumValue($options);
    }

    public function testInvalidNull()
    {
        $this->assertFalse($this->validator->validate(new TestEnum(null, false), new NotNullEnumValue()));
    }

    public function testMessageIsSet()
    {
        $constraint = new NotNullEnumValue(array(
            'messageNull' => 'myMessageNull'
        ));

        $this->context->expects($this->once())
            ->method('addViolation')
            ->with('myMessageNull');

        $this->assertFalse($this->validator->validate(new TestEnum(null, false), $constraint));
    }

}
