<?php

namespace NetTeam\Bundle\DDDBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
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
    public function buildViewBottomUp(FormView $view, FormInterface $form)
    {
        $type = $form->getAttribute('type');

        if ('percent' === $type) {
            $this->fixPercentType($view);
        } elseif ('money' === $type) {
            $this->fixMoneyType($view);
        }
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
    public function getDefaultOptions(array $options)
    {
        return array(
            'by_reference' => false,
            'error_bubbling' => false,
            'type' => 'number',
            'currency' => 'EUR',
        );
    }

    private function fixPercentType(FormView $view)
    {
        $types = $view->getChild('min')->get('types');
        $types[1] = 'text';

        $view->getChild('min')->set('types', $types);
        $view->getChild('max')->set('types', $types);

        $view->set('range_suffix', '%');
    }

    private function fixMoneyType(FormView $view)
    {
        // Wyciągamy walutę z pola "min" i wrzucamy jako "range_suffix"
        preg_match('/(.*)[\s]?{{ widget }}[\s]?(.*)/', $view->getChild('min')->get('money_pattern'), $matches);
        $currency = $matches[1] ? $matches[1] : $matches[2];
        $view->set('range_suffix', $currency);

        $view->getChild('min')->set('money_pattern', '{{ widget }}');
        $view->getChild('max')->set('money_pattern', '{{ widget }}');
    }
}
