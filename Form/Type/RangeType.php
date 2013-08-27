<?php

namespace NetTeam\Bundle\DDDBundle\Form\Type;

use NetTeam\Bundle\DDDBundle\Form\DataTransformer\MoneyRangeToRangeTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use NetTeam\Bundle\DDDBundle\Form\DataTransformer\RangeToArrayTransformer;

/**
 * Range type -- 2x input field
 *
 * @author Piotr Walków <piotr.walkow@netteam.pl>
 */
class RangeType extends AbstractType
{
    const ENTITY_CLASS = 'NetTeam\DDD\ValueObject\Range';

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $fieldOptions = array_intersect_key($options, array_flip(array(
            'trim',
            'required',
            'read_only',
            'max_length',
            'attr',
        )));

        $fieldOptions['error_bubbling'] = true;
        $fieldOptions['attr'] = array_merge(
            array('class' => 'input-small'),
            $fieldOptions['attr']
        );

        if ('money' === $options['type']) {
            $fieldOptions['currency'] = $options['currency'];
            $builder->setAttribute('currency', $options['currency']);
        }

        if ('money' === $options['input']) {
            $fieldOptions['use_value_object'] = true;
            $builder->addModelTransformer(new MoneyRangeToRangeTransformer());
        }

        $builder->setAttribute('type', $options['type']);

        $builder->add('min', $options['type'], array_merge($fieldOptions, $options['min_options']));
        $builder->add('max', $options['type'], array_merge($fieldOptions, $options['max_options']));

        $builder->addViewTransformer(new RangeToArrayTransformer());
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['range_suffix'] = $options['range_suffix'];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'range';
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'by_reference' => false,
            'error_bubbling' => false,
            'type' => 'number',
            'currency' => 'EUR',
            'range_suffix' => '',
            'input' => null,
            'min_options' => array(),
            'max_options' => array(),
        ));
    }
}
