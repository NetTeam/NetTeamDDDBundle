<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Validator\Constraints;

use NetTeam\Bundle\DDDBundle\Validator\Constraints\RangeValue;
use NetTeam\Bundle\DDDBundle\Validator\Constraints\RangeValueValidator;
use NetTeam\DDD\ValueObject\Range;
use Symfony\Component\Validator\Constraint;

/**
 * @author Krzysztof Menżyk <krzysztof.menzyk@netteam.pl>
 *
 * @group Unit
 */
class RangeValueConstraintValidatorTest extends \PHPUnit_Framework_TestCase
{
    protected $validator;

    protected function setUp()
    {
        $this->validator = new RangeValueValidator();
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testUnexpectedType()
    {
        $this->validator->isValid(new \stdClass, new RangeValue());
    }

    public function testValidValue()
    {
        $this->assertTrue($this->validator->isValid(new Range(1, 10, false), new RangeValue()));
    }

    public function testInvalidValue()
    {
        $this->assertFalse($this->validator->isValid(new Range(100, 1, false), new RangeValue()));
    }

    public function testMessageIsSet()
    {
        $constraint = new RangeValue(array(
            'message' => 'myMessage'
        ));

        $this->assertFalse($this->validator->isValid(new Range(100, 1, false), $constraint));
        $this->assertEquals($this->validator->getMessageTemplate(), 'myMessage');
    }

    public function testConstraintGetTargets()
    {
        $constraint = new RangeValue();

        $this->assertEquals(array(Constraint::CLASS_CONSTRAINT, Constraint::PROPERTY_CONSTRAINT), $constraint->getTargets());
    }
}
