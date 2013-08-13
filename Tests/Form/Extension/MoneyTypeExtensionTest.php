<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Form\Extension;

use NetTeam\Bundle\DDDBundle\Form\Extension\MoneyTypeExtension;
use NetTeam\DDD\ValueObject\Money;

/**
 * @author Krzysztof Menżyk <krzysztof.menzyk@netteam.pl>
 *
 * @group Unit
 */
class MoneyTypeExtensionTest extends TypeExtensionTestCase
{
    protected function getTypeExtensions()
    {
        return array(
            new MoneyTypeExtension(),
        );
    }

    public function testBindUsingValueObject()
    {
        $form = $this->factory->create('money', null, array(
            'use_value_object' => true,
        ));

        $form->bind('123');

        $this->assertEquals(new Money(123, 'EUR'), $form->getData());
        $this->assertSame(123.0, $form->getNormData());
    }

    public function testBindUsingDefault()
    {
        $form = $this->factory->create('money');

        $form->bind('123');

        $this->assertSame(123.0, $form->getData());
        $this->assertSame(123.0, $form->getNormData());
    }
}
