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

    protected function setUp()
    {
        $this->validator = new EnumValueValidator();
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testUnexpectedType()
    {
        $this->validator->isValid(new \stdClass, new EnumValue());
    }

    public function testValidValue()
    {
        $this->assertTrue($this->validator->isValid(new TestEnum(TestEnum::ONE), new EnumValue()));
    }

    public function testInvalidValue()
    {
        $this->assertFalse($this->validator->isValid(new TestEnum(-100, false), new EnumValue()));
    }

    public function testMessageIsSet()
    {
        $constraint = new EnumValue(array(
            'message' => 'myMessage'
        ));

        $this->assertFalse($this->validator->isValid(new TestEnum(-100, false), $constraint));
        $this->assertEquals($this->validator->getMessageTemplate(), 'myMessage');
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
