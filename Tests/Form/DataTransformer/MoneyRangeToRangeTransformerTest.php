<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Form\DataTransfomer;

use NetTeam\Bundle\DDDBundle\Form\DataTransformer\MoneyRangeToRangeTransformer;
use NetTeam\DDD\ValueObject\Money;
use NetTeam\DDD\ValueObject\MoneyRange;
use NetTeam\DDD\ValueObject\Range;

/**
 * @group Unit
 *
 * @author Paweł Macyszyn <pawel.macyszyn@netteam.pl>
 */
class MoneyRangeToRangeTransformerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MoneyRangeToRangeTransformer
     */
    protected $transformer;

    public function setUp()
    {
        $this->transformer = new MoneyRangeToRangeTransformer();
    }

    public function tearDown()
    {
        $this->transformer = null;
    }

    /**
     * @dataProvider transformProvider
     */
    public function testTransform($expected, $actual)
    {
        $value = $this->transformer->transform($actual);

        $this->assertInstanceOf('NetTeam\DDD\ValueObject\Range', $value);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider transformProvider
     */
    public function testReverseTransform($actual, $expected)
    {
        $value = $this->transformer->reverseTransform($actual);

        $this->assertInstanceOf('NetTeam\DDD\ValueObject\MoneyRange', $value);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider invalidTypeTransformProvider
     * @expectedException \UnexpectedValueException
     */
    public function testTransformInvalidArgumentException($type)
    {
        $this->transformer->transform($type);
    }

    /**
     * @dataProvider invalidTypeReversedTransformProvider
     * @expectedException \UnexpectedValueException
     */
    public function testReverseTransformInvalidArgumentException($type)
    {
        $this->transformer->reverseTransform($type);
    }

    public function transformProvider()
    {
        return array(
            array(new Range(new Money(10, 'PLN'), new Money(100, 'PLN')), new MoneyRange(new Money(10, 'PLN'), new Money(100, 'PLN'))),
            array(new Range(new Money(0, 'PLN'), new Money(0, 'PLN')), new MoneyRange(new Money(0, 'PLN'), new Money(0, 'PLN'))),
        );
    }

    public function invalidTypeTransformProvider()
    {
        return array(
            array(\Mockery::mock()),
            array('string'),
            array(true),
            array(10),
            array(new Range()),
        );
    }

    public function invalidTypeReversedTransformProvider()
    {
        return array(
            array(\Mockery::mock()),
            array('string'),
            array(true),
            array(10),
        );
    }
}
