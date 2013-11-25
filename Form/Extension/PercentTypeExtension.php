<?php

namespace NetTeam\Bundle\DDDBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilder;
use NetTeam\Bundle\DDDBundle\Form\DataTransformer\PercentToNumberTransformer;

/**
 * Class PercentTypeExtension
 *
 * @author Paweł Macyszyn <pawel.macyszyn@netteam.pl>
 */
class PercentTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        if ($options['use_value_object']) {
            $builder->prependClientTransformer(new PercentToNumberTransformer());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'percent';
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
}
