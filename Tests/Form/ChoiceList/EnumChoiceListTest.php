<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Form\ChoiceList;

use Symfony\Component\Form\Extension\Core\View\ChoiceView;
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
        $enumChoiceList = new EnumChoiceList($this->getMockTranslator(), 'NetTeam\Bundle\DDDBundle\Tests\Form\ChoiceList\ExampleEnum', 'prefix', 'domain', array());

        $this->assertEquals(array(
            0 => new ChoiceView(1, 1, 'prefix.exampleEnum.one'),
            1 => new ChoiceView(2, 2, 'prefix.exampleEnum.two'),
        ), $enumChoiceList->getRemainingViews());
    }

    public function testWithDefaultChoices()
    {
        $choices = array(
            1 => 'choice.one',
            2 => 'choice.two',
        );

        $enumChoiceList = new EnumChoiceList($this->getMockTranslator(), 'NetTeam\Bundle\DDDBundle\Tests\Form\ChoiceList\ExampleEnum', 'prefix', 'domain', $choices);

        $this->assertEquals(array(
            0 => new ChoiceView(1, 1, 'prefix.choice.one'),
            1 => new ChoiceView(2, 2, 'prefix.choice.two'),
        ), $enumChoiceList->getRemainingViews());
    }

    public function testWithEmptyPrefix()
    {
        $enumChoiceList = new EnumChoiceList($this->getMockTranslator(), 'NetTeam\Bundle\DDDBundle\Tests\Form\ChoiceList\ExampleEnum', '', 'domain', array());

        $this->assertEquals(array(
            0 => new ChoiceView(1, 1, 'exampleEnum.one'),
            1 => new ChoiceView(2, 2, 'exampleEnum.two'),
        ), $enumChoiceList->getRemainingViews());
    }

    public function testWithNullPrefix()
    {
        $enumChoiceList = new EnumChoiceList($this->getMockTranslator(), 'NetTeam\Bundle\DDDBundle\Tests\Form\ChoiceList\ExampleEnum', null, 'domain', array());

        $this->assertEquals(array(
            0 => new ChoiceView(1, 1, 'exampleEnum.one'),
            1 => new ChoiceView(2, 2, 'exampleEnum.two'),
        ), $enumChoiceList->getRemainingViews());
    }

    public function testArrayOfArrayChoices()
    {
        $choices = array(
            'group1' => array(1 => 'choice.one', 2 => 'choice.two'),
            'group2' => array(3 => 'choice.three', 4 => 'choice.four'),
        );

        $enumChoiceList = new EnumChoiceList($this->getMockTranslator(), 'NetTeam\Bundle\DDDBundle\Tests\Form\ChoiceList\ExampleEnum', 'prefix', 'domain', $choices);

        $this->assertEquals(array(
            'group1' => array(
                0 => new ChoiceView(1, 1, 'prefix.choice.one'),
                1 => new ChoiceView(2, 2, 'prefix.choice.two'),
            ),
            'group2' => array(
                2 => new ChoiceView(4, 4, 'prefix.choice.four'),
                3 => new ChoiceView(3, 3, 'prefix.choice.three'),
            ),
        ), $enumChoiceList->getRemainingViews());
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
