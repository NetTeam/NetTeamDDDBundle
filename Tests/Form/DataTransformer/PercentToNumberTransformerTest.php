<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Form\DataTransfomer;

use NetTeam\Bundle\DDDBundle\Form\DataTransformer\PercentToNumberTransformer;
use NetTeam\DDD\ValueObject\Percent;

/**
 * @group Unit
 *
 * @author Paweł Macyszyn <pawel.macyszyn@netteam.pl>
 */
class PercentToNumberTransformerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PercentToNumberTransformer
     */
    protected $transformer;

    public function setUp()
    {
        $this->transformer = new PercentToNumberTransformer();
    }

    public function tearDown()
    {
        $this->transformer = null;
    }

    public function testTransform()
    {
        $value = $this->transformer->transform(new Percent(0.1));

        $this->assertEquals(0.1, $value);
    }

    public function testTransformNull()
    {
        $this->assertNull($this->transformer->transform(null));
    }

    /**
     * @dataProvider invalidTypeTransformProvider
     * @expectedException Symfony\Component\Form\Exception\TransformationFailedException
     */
    public function testTransformInvalidArgumentException($type)
    {
        $this->transformer->transform($type);
    }

    public function invalidTypeTransformProvider()
    {
        return array(
            array(\Mockery::mock()),
            array(1),
            array(0.1),
            array('string'),
        );
    }

    public function testReverseTransform()
    {
        $value = $this->transformer->reverseTransform(0.1);

        $this->assertInstanceOf('NetTeam\DDD\ValueObject\Percent', $value);
        $this->assertEquals(0.1, $value->value());
    }

    public function testReverseTransformNull()
    {
        $this->assertNull($this->transformer->reverseTransform(null));
    }

    /**
     * @dataProvider invalidTypeReversedTransformProvider
     * @expectedException Symfony\Component\Form\Exception\TransformationFailedException
     */
    public function testReverseTransformInvalidArgumentException($type)
    {
        $this->transformer->reverseTransform($type);
    }

    public function invalidTypeReversedTransformProvider()
    {
        return array(
            array(\Mockery::mock()),
            array('string'),
        );
    }
}
