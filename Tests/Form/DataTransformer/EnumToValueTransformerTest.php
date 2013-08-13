<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Form\DataTransfomer;

use NetTeam\DDD\Enum;
use NetTeam\Bundle\DDDBundle\Form\DataTransformer\EnumToValueTransformer;

/**
 * @author Piotr Walków <piotr.walkow@netteam.pl>
 * @author Krzysztof Menżyk <krzysztof.menzyk@netteam.pl>
 *
 * @group Unit
 */
class EnumToValueTransformerTest extends \PHPUnit_Framework_TestCase
{
    protected $transformer;

    protected function setUp()
    {
        $this->transformer = new EnumToValueTransformer('NetTeam\Bundle\DDDBundle\Tests\Form\DataTransfomer\TestEnum');
    }

    protected function tearDown()
    {
        $this->transformer = null;
    }

    public function transformProvider()
    {
        return array(
            array(null, ''),
            array('', ''),
            array(new TestEnum(TestEnum::__NULL), TestEnum::__NULL),
            array(new TestEnum(TestEnum::FIRST), TestEnum::FIRST),
            array(new TestEnum(TestEnum::SECOND), TestEnum::SECOND),
            array(new TestEnum(TestEnum::STRING), TestEnum::STRING),
        );
    }

    /**
     * @dataProvider transformProvider
     */
    public function testTransform($in, $out)
    {
        $this->assertSame($out, $this->transformer->transform($in));
    }

    public function reverseTransformProvider()
    {
        return array(
            array('', new TestEnum(TestEnum::__NULL)),
            array(TestEnum::__NULL, new TestEnum(TestEnum::__NULL)),
            array(TestEnum::FIRST, new TestEnum(TestEnum::FIRST)),
            array(TestEnum::SECOND, new TestEnum(TestEnum::SECOND)),
            array(TestEnum::STRING, new TestEnum(TestEnum::STRING)),
        );
    }

    /**
     * @dataProvider reverseTransformProvider
     */
    public function testReverseTransform($in, $out)
    {
        $this->assertEquals($out, $this->transformer->reverseTransform($in));
    }

    /**
     * @expectedException Symfony\Component\Form\Exception\TransformationFailedException
     */
    public function testTransformExpectsInstanceOfEnumClass()
    {
        $this->transformer->transform(new \stdClass());
    }

    /**
     * @expectedException Symfony\Component\Form\Exception\TransformationFailedException
     */
    public function testReverseTransformExpectsScalar()
    {
        $this->transformer->reverseTransform(array());
    }
}

class TestEnum extends Enum
{
    const FIRST = 1;

    const SECOND = 2;

    const STRING = 'test_value';
}
