<?php

namespace NetTeam\Bundle\DDDBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Exception\MissingOptionsException;
use NetTeam\Bundle\DDDBundle\Form\DataTransformer\StringToEnumTransformer;
use NetTeam\DDD\Enum;

class EnumType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (null === $options['class']) {
            throw new MissingOptionsException('The option "class" must be defined', array('class'));
        }

        $builder->prependClientTransformer(new StringToEnumTransformer($options['class']));
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'class' => null,
        );
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
