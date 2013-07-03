<?php

namespace NetTeam\Bundle\DDDBundle\Form\Type;

use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Exception\MissingOptionsException;
use NetTeam\Bundle\DDDBundle\Form\DataTransformer\StringToEnumTransformer;
use NetTeam\Bundle\DDDBundle\Form\DataTransformer\EnumsToValuesTransformer;
use NetTeam\Bundle\DDDBundle\Form\ChoiceList\EnumChoiceList;

class EnumType extends AbstractType
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        if (null === $options['class']) {
            throw new MissingOptionsException('The option "class" must be defined', array('class'));
        }

        if ($options['multiple']) {
            $builder->prependClientTransformer(new EnumsToValuesTransformer($options['class']));

            return;
        }

        $builder->prependClientTransformer(new StringToEnumTransformer($options['class']));
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array $options)
    {
        $defaultOptions = array(
            'class'        => null,
            'trans_prefix' => '',
            'trans_domain' => 'messages',
            'choices'      => null,
            'choice_list'  => null,
        );

        $options = array_replace($defaultOptions, $options);

        if (!isset($options['choice_list'])) {
            $defaultOptions['choice_list'] = new EnumChoiceList(
                $this->translator,
                $options['class'],
                $options['trans_prefix'],
                $options['trans_domain'],
                $options['choices']
            );
        }

        return $defaultOptions;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(array $options)
    {
        return 'choice';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'enum';
    }

}
