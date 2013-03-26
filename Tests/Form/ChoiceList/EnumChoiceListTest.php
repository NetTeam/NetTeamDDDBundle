<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Form\ChoiceList;

use NetTeam\Bundle\DDDBundle\Form\ChoiceList\EnumChoiceList;
use NetTeam\DDD\Enum;

/**
 * @author Paweł Macyszyn <pawel.macyszyn@netteam.pl>
 *
 * @group Unit
 */
class EnumChoiceListTest extends \PHPUnit_Framework_TestCase
{
    public function testWithoutDefaultChoices()
    {
        $enumChoiceList = new EnumChoiceList($this->getMockTranslator(), 'NetTeam\Bundle\DDDBundle\Tests\Form\ChoiceList\ExampleEnum', 'prefix', 'domain', null);
        $choices = $enumChoiceList->getChoices();

        $this->assertEquals('prefix.exampleEnum.one', $choices[1]);
        $this->assertEquals('prefix.exampleEnum.two', $choices[2]);
    }

    public function testWithDefaultChoices()
    {
        $choices = array(
            1 => 'choice.one',
            2 => 'choice.two',
        );

        $enumChoiceList = new EnumChoiceList($this->getMockTranslator(), 'NetTeam\Bundle\DDDBundle\Tests\Form\ChoiceList\ExampleEnum', 'prefix', 'domain', $choices);
        $choices = $enumChoiceList->getChoices();

        $this->assertEquals('prefix.choice.one', $choices[1]);
        $this->assertEquals('prefix.choice.two', $choices[2]);
    }

    public function testWithEmptyPrefix()
    {
        $enumChoiceList = new EnumChoiceList($this->getMockTranslator(), 'NetTeam\Bundle\DDDBundle\Tests\Form\ChoiceList\ExampleEnum', '', 'domain', null);
        $choices = $enumChoiceList->getChoices();

        $this->assertEquals('exampleEnum.one', $choices[1]);
        $this->assertEquals('exampleEnum.two', $choices[2]);
    }

    public function testWithNullPrefix()
    {
        $enumChoiceList = new EnumChoiceList($this->getMockTranslator(), 'NetTeam\Bundle\DDDBundle\Tests\Form\ChoiceList\ExampleEnum', null, 'domain', null);
        $choices = $enumChoiceList->getChoices();

        $this->assertEquals('exampleEnum.one', $choices[1]);
        $this->assertEquals('exampleEnum.two', $choices[2]);
    }

    public function testArrayOfArrayChoices()
    {
        $choices = array(
            'group1' => array('choice.one', 'choice.two'),
            'group2' => array('choice.three', 'choice.four'),
        );

        $enumChoiceList = new EnumChoiceList($this->getMockTranslator(), 'NetTeam\Bundle\DDDBundle\Tests\Form\ChoiceList\ExampleEnum', 'prefix', 'domain', $choices);

        $expected = array(
            'group1' => array('prefix.choice.one', 'prefix.choice.two'),
            'group2' => array('prefix.choice.three', 'prefix.choice.four'),
        );
        $this->assertSame($expected, $enumChoiceList->getChoices());
    }

    private function getMockTranslator()
    {
        return \Mockery::mock('Symfony\Component\Translation\TranslatorInterface')
            ->shouldReceive('trans')
            ->andReturnUsing(function ($value) { return $value; })
            ->getMock()
            ;
    }
}

class ExampleEnum extends Enum
{
    const ONE = 1;
    const TWO = 2;
}
