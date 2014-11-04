<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Form\Type;

use NetTeam\Bundle\DDDBundle\Tests\Form\Extension\TypeExtensionTestCase;
use NetTeam\Bundle\DDDBundle\Form\Extension\MoneyTypeExtension;
use NetTeam\Bundle\DDDBundle\Form\Type\RangeType;
use NetTeam\DDD\ValueObject\DateRange;
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

    public function testSubmitWhenTypeAndInputIsMoney()
    {
        $formData = array(
            'min' => 100,
            'max' => 1000,
        );

        $object = new MoneyRange(Money::PLN(100), Money::PLN(1000));

        $form = $this->factory->create(new RangeType(), null, array(
            'range_class' => 'NetTeam\DDD\ValueObject\MoneyRange',
            'type'       => 'money',
            'input'      => 'money',
            'currency'   => 'PLN',
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

    public function testSubmitDateRange()
    {
        $formData = array(
            'min' => '2014-01-01',
            'max' => '2014-12-31',
        );

        $object = new DateRange(new \DateTime('2014-01-01'), new \DateTime('2014-12-31'));

        $form = $this->factory->create(new RangeType(), null, array(
            'range_class' =>  'NetTeam\DDD\ValueObject\DateRange',
            'type' =>  'date',
            'min_options' => array(
                'widget' => 'single_text',
            ),
            'max_options' => array(
                'widget' => 'single_text',
            ),
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

    public function testMinOptions()
    {
        $minOptions = array(
            'attr' => array('class' => 'input-mini'),
            'required' => false,
            'error_bubbling' => true,
        );

        $form = $this->factory->create(new RangeType(), null, array(
            'min_options' => $minOptions,
        ));

        $options = $form->get('min')->getConfig()->getOptions();

        foreach ($minOptions as $name => $option) {
            $this->assertEquals($option, $options[$name]);
        }
    }

    public function testMaxOptions()
    {
        $maxOptions = array(
            'attr' => array('class' => 'input-mini'),
            'required' => false,
            'error_bubbling' => true,
        );

        $form = $this->factory->create(new RangeType(), null, array(
            'max_options' => $maxOptions,
        ));

        $options = $form->get('max')->getConfig()->getOptions();

        foreach ($maxOptions as $name => $option) {
            $this->assertEquals($option, $options[$name]);
        }
    }
}
