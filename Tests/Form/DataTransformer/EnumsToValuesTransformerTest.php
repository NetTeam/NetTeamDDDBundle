<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Form\DataTransfomer;

use NetTeam\DDD\Enum;
use NetTeam\Bundle\DDDBundle\Form\DataTransformer\EnumsToValuesTransformer;

/**
 * @author Dawid Drelichowski <dawid.drelichowski@netteam.pl>
 *
 * @group Unit
 */
class EnumsToValuesTransformerTest extends \PHPUnit_Framework_TestCase
{
    protected $transformer;

    protected function setUp()
    {
        $this->transformer = new EnumsToValuesTransformer('NetTeam\Bundle\DDDBundle\Tests\Form\DataTransfomer\TestEnums');
    }

    protected function tearDown()
    {
        $this->transformer = null;
    }

    public function transformProvider()
    {
        return array(
            array(null, array()),
            array(
                array(
                    new TestEnums(TestEnums::FIRST),
                    new TestEnums(TestEnums::SECOND)
                ),
                array(
                    TestEnums::FIRST,
                    TestEnums::SECOND
                )
            ),
            array(
                array(
                    new TestEnums(TestEnums::STRING)
                ),
                 array(
                     TestEnums::STRING
                 )
            )
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
            array(null, array()),
            array(
                array(
                    (string) TestEnums::FIRST,
                    (string) TestEnums::SECOND
                ),
                array(
                    new TestEnums(TestEnums::FIRST),
                    new TestEnums(TestEnums::SECOND)
                )
            ),
            array(
                array(
                    TestEnums::STRING
                ),
                array(
                    new TestEnums(TestEnums::STRING)
                )
            )
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
     * @expectedException \Symfony\Component\Form\Exception\TransformationFailedException
     */
    public function testTransformExpectsArray()
    {
        $this->transformer->transform('string');
    }

    /**
     * @expectedException \Symfony\Component\Form\Exception\TransformationFailedException
     */
    public function testReverseTransformExpectsArray()
    {
        $this->transformer->reverseTransform('string');
    }
}

class TestEnums extends Enum
{
    const FIRST = 1;

    const SECOND = 2;

    const STRING = 'test_value';
}
