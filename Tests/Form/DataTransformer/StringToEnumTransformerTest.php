<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Form\DataTransfomer;

use NetTeam\DDD\Enum;
use NetTeam\Bundle\DDDBundle\Form\DataTransformer\StringToEnumTransformer;

/**
 * @author Piotr Walków <piotr.walkow@netteam.pl>
 *
 * @group Unit
 */
class StringToEnumTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function testTransformsWithNullValue()
    {
        $value = null;
        $enum = new TestEnum($value);

        $stringToEnumTransformer = new StringToEnumTransformer(get_class($enum));

        // transform
        $string = $stringToEnumTransformer->transform($enum);
        $this->assertSame($string, $value);

        // reverse transform
        $object = $stringToEnumTransformer->reverseTransform(Enum::__NULL);
        $this->assertEquals($object, $enum);
        $this->assertSame($object->get(), $enum->get());
    }

    public function testTransformsInteger()
    {
        $value = 2;
        $enum = new TestEnum($value);

        $stringToEnumTransformer = new StringToEnumTransformer(get_class($enum));

        // transform
        $string = $stringToEnumTransformer->transform($enum);
        $this->assertSame($string, $value);

        // reverse transform
        $object = $stringToEnumTransformer->reverseTransform('2');
        $this->assertEquals($object, $enum);
        $this->assertSame($object->get(), $enum->get());
    }

    public function testTransformsWithStringValue()
    {
        $value = 'test_value';
        $enum = new TestEnum($value);

        $stringToEnumTransformer = new StringToEnumTransformer(get_class($enum));

        // transform
        $string = $stringToEnumTransformer->transform($enum);
        $this->assertSame($string, $value);

        // reverse transform
        $object = $stringToEnumTransformer->reverseTransform('test_value');
        $this->assertEquals($object, $enum);
        $this->assertSame($object->get(), $enum->get());
    }
}

class TestEnum extends Enum
{
    const FIRST = 1;

    const SECOND = 2;

    const THIRD = 'test_value';
}
