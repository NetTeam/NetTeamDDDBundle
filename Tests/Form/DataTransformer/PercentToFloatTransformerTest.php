<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Form\DataTransfomer;

use NetTeam\Bundle\DDDBundle\Form\DataTransformer\PercentToFloatTransformer;
use NetTeam\DDD\ValueObject\Percent;

/**
 * @group Unit
 *
 * @author Paweł Macyszyn <pawel.macyszyn@netteam.pl>
 */
class PercentToFloatTransformerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PercentToFloatTransformer
     */
    protected $transformer;

    public function setUp()
    {
        $this->transformer = new PercentToFloatTransformer();
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

    public function testReverseTransform()
    {
        $value = $this->transformer->reverseTransform(0.1);

        $this->assertInstanceOf('NetTeam\DDD\ValueObject\Percent', $value);
        $this->assertEquals(0.1, $value->value());
    }

    /**
     * @dataProvider invalidTypeTransformProvider
     * @expectedException \UnexpectedValueException
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

    /**
     * @dataProvider invalidTypeReversedTransformProvider
     * @expectedException \UnexpectedValueException
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
