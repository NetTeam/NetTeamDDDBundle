<?php

namespace NetTeam\Bundle\DDDBundle\Form\Extension;

use NetTeam\Bundle\DDDBundle\Form\DataTransformer\MoneyToNumberTransformer;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilder;

/**
 * @author Paweł A. Wacławczyk <p.a.waclawczyk@gmail.com>
 */
class MoneyTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'money';
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array $options)
    {
        $defaults = array(
            'use_value_object' => false,
        );

        return array_merge($defaults, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        if ($options['use_value_object']) {
            $builder->prependClientTransformer(new MoneyToNumberTransformer($options['currency']));
        }
    }
}
