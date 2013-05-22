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
    }

    protected function getConstraint($options = null)
    {
        return new EnumValue($options);
    }

    public function testConstraintGetTargets()
    {
        $constraint = new EnumValue();

        $this->assertEquals('class', $constraint->getTargets());
    }
}
