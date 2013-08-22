<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Form\Type;

use NetTeam\Bundle\DDDBundle\Tests\Form\Extension\TypeExtensionTestCase;
use NetTeam\Bundle\DDDBundle\Form\Extension\MoneyTypeExtension;
use NetTeam\Bundle\DDDBundle\Form\Type\RangeType;
use NetTeam\DDD\ValueObject\Money;
use NetTeam\DDD\ValueObject\MoneyRange;

/**
 * @group Unit
 *
 * @author Paweł Macyszyn <pawel.macyszyn@netteam.pl>
 */
class RangeTypeTest extends TypeExtensionTestCase
{
    protected function getTypeExtensions()
    {
        return array(
            new MoneyTypeExtension(),
        );
    }

    public function testSubmitValidData()
    {
        $formData = array(
            'min' => 100,
            'max' => 1000,
        );

        $object = new MoneyRange(Money::PLN(100), Money::PLN(1000));

        $form = $this->factory->create(new RangeType(), null, array(
            'type' => 'money',
            'input' => 'money',
            'currency' => 'PLN',
        ));

        // submit the data to the form directly
        $form->bind($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}