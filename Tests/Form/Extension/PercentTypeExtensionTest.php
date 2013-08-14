<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Form\Extension;

use NetTeam\Bundle\DDDBundle\Form\Extension\PercentTypeExtension;
use NetTeam\DDD\ValueObject\Percent;

/**
 * @author Krzysztof Menżyk <krzysztof.menzyk@netteam.pl>
 *
 * @group Unit
 */
class PercentTypeExtensionTest extends TypeExtensionTestCase
{
    protected function getTypeExtensions()
    {
        return array(
            new PercentTypeExtension(),
        );
    }

    public function testBindUsingValueObject()
    {
        $form = $this->factory->create('percent', null, array(
            'use_value_object' => true,
        ));

        $form->bind('45');

        $this->assertEquals(new Percent(0.45), $form->getData());
        $this->assertSame(0.45, $form->getNormData());
    }

    public function testBindUsingDefault()
    {
        $form = $this->factory->create('percent');

        $form->bind('45');

        $this->assertSame(0.45, $form->getData());
        $this->assertSame(0.45, $form->getNormData());
    }
}
