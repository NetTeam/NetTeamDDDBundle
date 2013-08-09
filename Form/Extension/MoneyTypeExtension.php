<?php

namespace NetTeam\Bundle\DDDBundle\Form\Extension;

use NetTeam\Bundle\DDDBundle\Form\DataTransformer\MoneyToNumberTransformer;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'use_value_object' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['use_value_object']) {
            $builder->addModelTransformer(new MoneyToNumberTransformer($options['currency']));
        }
    }
}
