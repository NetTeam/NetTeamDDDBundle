<?php

namespace NetTeam\Bundle\DDDBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use NetTeam\Bundle\DDDBundle\Form\DataTransformer\ArrayToRangeTransformer;

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
            if (!isset($options['currency'])) {
                throw new \Symfony\Component\Form\Exception\MissingOptionsException('currency');
            }

            $fieldOptions['currency'] = $options['currency'];
            $builder->setAttribute('currency', $options['currency']);
        }

        $builder->setAttribute('type', $options['type']);

        $builder->add('min', $options['type'], $fieldOptions);
        $builder->add('max', $options['type'], $fieldOptions);

        $builder->appendClientTransformer(new ArrayToRangeTransformer());
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
        );
    }

}
