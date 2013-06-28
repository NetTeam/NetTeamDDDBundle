<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Validator\Constraints;

use NetTeam\Bundle\DDDBundle\Validator\Constraints\EnumValueValidator;
use NetTeam\Bundle\DDDBundle\Validator\Constraints\EnumValue;

/**
 * @author Krzysztof Menżyk <krzysztof.menzyk@netteam.pl>
 *
 * @group Unit
 */
class EnumValueValidatorTest extends EnumValueValidatorBase
{

    protected function setUp()
    {
        $this->validator = new EnumValueValidator();
        $this->context = $this->getMock('Symfony\Component\Validator\ExecutionContext', array(), array(), '', false);
        $this->validator->initialize($this->context);
    }

    public function testConstraintGetTargets()
    {
        $constraint = new EnumValue();

        $this->assertEquals('class', $constraint->getTargets());
    }

    protected function getConstraint($options = null)
    {
        return new EnumValue($options);
    }

}
