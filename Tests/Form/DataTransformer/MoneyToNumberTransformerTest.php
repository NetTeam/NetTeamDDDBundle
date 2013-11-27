<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Form\DataTransfomer;

use NetTeam\DDD\ValueObject\Money;
use NetTeam\Bundle\DDDBundle\Form\DataTransformer\MoneyToNumberTransformer;

/**
 * @author Paweł A. Wacławczyk <p.a.waclawczyk@gmail.com>
 * @author Krzysztof Menżyk <krzysztof.menzyk@netteam.pl>
 */
class MoneyToNumberTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function testTransform()
    {
        $transformer = new MoneyToNumberTransformer('PLN');

        $this->assertEquals(123.45, $transformer->transform(new Money(123.45, 'PLN')));
    }

    public function testTransformNull()
    {
        $transformer = new MoneyToNumberTransformer('PLN');

        $this->assertNull($transformer->transform(null));
    }

    /**
     * @expectedException Symfony\Component\Form\Exception\TransformationFailedException
     */
    public function testTransformExpectsMoney()
    {
        $transformer = new MoneyToNumberTransformer('PLN');

        $transformer->transform('abcd');
    }

    public function testReverseTransform()
    {
        $transformer = new MoneyToNumberTransformer('USD');

        $this->assertEquals(new Money(123.45, 'USD'), $transformer->reverseTransform(123.45));
    }

    public function testReverseTransformNull()
    {
        $transformer = new MoneyToNumberTransformer('USD');

        $this->assertNull($transformer->reverseTransform(null));
    }

    /**
     * @expectedException Symfony\Component\Form\Exception\TransformationFailedException
     */
    public function testReverseTransformExpectsNumeric()
    {
        $transformer = new MoneyToNumberTransformer('PLN');

        $transformer->reverseTransform('abcd');
    }
}
