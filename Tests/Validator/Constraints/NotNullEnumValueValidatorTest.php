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
    }

    protected function getConstraint($options = null)
    {
        return new NotNullEnumValue($options);
    }

    public function testInvalidNull()
    {
        $this->assertFalse($this->validator->isValid(new TestEnum(null, false), new NotNullEnumValue()));
    }

    public function testMessageIsSetIfNull()
    {
        $constraint = new NotNullEnumValue(array(
            'messageNull' => 'myMessageNull'
        ));

        $this->assertFalse($this->validator->isValid(new TestEnum(null, false), $constraint));
        $this->assertEquals($this->validator->getMessageTemplate(), 'myMessageNull');
    }
}
