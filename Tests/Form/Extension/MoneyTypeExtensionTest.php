<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Form\Extension;

use NetTeam\DDD\ValueObject\Money;
use NetTeam\Bundle\DDDBundle\Form\Extension\MoneyTypeExtension;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

/**
 * @author Paweł A. Wacławczyk <p.a.waclawczyk@gmail.com>
 */
class MoneyTypeExtensionTest extends TypeTestCase
{

    protected function setUp()
    {
        $this->markTestSkipped();
    }

    public function testForm()
    {

        $type = new MoneyType();

        $form = $this->factory->create($type); //, null, array('use_value_object' => true));
        $money = new Money(123.45, 'PLN');

        $form->submit(array(123.45));

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($money, $form->getData());
    }

    protected function getExtensions()
    {
        return array_merge(parent::getExtensions(), array(
            new MoneyTypeExtension()
        ));
    }
}
