<?php

namespace NetTeam\Bundle\DDDBundle\Form\Type;

use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\Options;
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
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (null === $options['class']) {
            throw new MissingOptionsException('The option "class" must be defined', array('class'));
        }

        if ($options['multiple']) {
            $builder->addViewTransformer(new EnumsToValuesTransformer($options['class']), true);

            return;
        }

        $builder->addViewTransformer(new StringToEnumTransformer($options['class']), true);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $translator = $this->translator;
        $choiceList = function (Options $options) use ($translator) {
            return new EnumChoiceList(
                $translator,
                $options['class'],
                $options['trans_prefix'],
                $options['trans_domain'],
                $options['choices']
            );
        };

        $resolver->setDefaults(array(
            'class'        => null,
            'trans_prefix' => '',
            'trans_domain' => 'messages',
            'choice_list'  => $choiceList,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
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
