<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Form\DataTransfomer;

use NetTeam\Bundle\DDDBundle\Form\DataTransformer\RangeToArrayTransformer;
use NetTeam\DDD\ValueObject\Range;

/**
 * @author Krzysztof Menżyk <krzysztof.menzyk@netteam.pl>
 *
 * @group Unit
 */
class RangeToArrayTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function testTransform()
    {
        $transformer = new RangeToArrayTransformer();

        $expected = array(
            'min' => 1,
            'max' => 2,
        );
        $this->assertEquals($expected, $transformer->transform(new Range(1, 2)));
    }

    public function testTransformNull()
    {
        $transformer = new RangeToArrayTransformer();

        $expected = array(
            'min' => null,
            'max' => null,
        );
        $this->assertEquals($expected, $transformer->transform(null));
    }

    /**
     * @expectedException Symfony\Component\Form\Exception\TransformationFailedException
     */
    public function testTransformExpectsRange()
    {
        $transformer = new RangeToArrayTransformer();

        $transformer->transform('abcd');
    }

    public function testReverseTransform()
    {
        $transformer = new RangeToArrayTransformer();

        $this->assertEquals(new Range(1, 2), $transformer->reverseTransform(array('min' => 1, 'max' => 2)));
    }

    public function testReverseTransformNullValues()
    {
        $transformer = new RangeToArrayTransformer();

        $this->assertEquals(new Range(null, null), $transformer->reverseTransform(array('min' => null, 'max' => null)));
    }

    /**
     * @expectedException Symfony\Component\Form\Exception\TransformationFailedException
     */
    public function testReverseTransformExpectsArray()
    {
        $transformer = new RangeToArrayTransformer();

        $transformer->reverseTransform('abcd');
    }
}
