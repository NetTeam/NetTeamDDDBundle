<?php

namespace NetTeam\Bundle\DDDBundle\Form\Extension;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use NetTeam\Bundle\DDDBundle\Form\DataTransformer\PercentToFloatTransformer;

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
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['use_value_object']) {
            $builder->addModelTransformer(new PercentToFloatTransformer());
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
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'use_value_object' => false,
        ));
    }
}
