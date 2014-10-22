<?php
/**
 * Created by PhpStorm.
 * User: pwc
 * Date: 20.10.14
 * Time: 11:53
 */

namespace NetTeam\Bundle\DDDBundle\Tests\Form\DataTransfomer;

use NetTeam\Bundle\DDDBundle\Form\DataTransformer\DateRangeToRangeTransformer;
use NetTeam\DDD\ValueObject\DateRange;
use NetTeam\DDD\ValueObject\Range;

class DateRangeToRangeTransformerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DateRangeToRangeTransformer
     */
    private $sut;

    protected function setUp()
    {
        $this->sut = new DateRangeToRangeTransformer();
    }

    public function testTransform()
    {
        $value = new DateRange(new \DateTime('2014-01-01'), new \DateTime('2014-12-31'));
        $expected = new Range(new \DateTime('2014-01-01'), new \DateTime('2014-12-31'));

        $this->assertEquals($expected, $this->sut->transform($value));
    }

    public function testTransformNullValueShouldReturnDateRangeWithEmptyLimits()
    {
        $value = null;
        $expected = new Range(null, null);

        $this->assertEquals($expected, $this->sut->transform($value));
    }

    /**
     * @expectedException \Symfony\Component\Form\Exception\TransformationFailedException
     */
    public function testTransformFailureOnInvalidValueType()
    {
        $value = new \stdClass();
        $expected = new Range(new \DateTime('2014-01-01'), new \DateTime('2014-12-31'));

        $this->assertEquals($expected, $this->sut->transform($value));
    }

    public function testReverseTransform()
    {
        $value = new Range(new \DateTime('2014-01-01'), new \DateTime('2014-12-31'));
        $expected = new DateRange(new \DateTime('2014-01-01'), new \DateTime('2014-12-31'));

        $this->assertEquals($expected, $this->sut->reverseTransform($value));
    }

    public function testReverseTransformNullValueShouldReturnDateRangeWithoutLimits()
    {
        $value = null;
        $expected = new DateRange();

        $this->assertEquals($expected, $this->sut->reverseTransform($value));
    }

    /**
     * @expectedException \Symfony\Component\Form\Exception\TransformationFailedException
     */
    public function testReverseTransformFailureOnInvalidValueType()
    {
        $value = new \stdClass();
        $expected = new DateRange();

        $this->assertEquals($expected, $this->sut->reverseTransform($value));
    }
}
