<?php

namespace NetTeam\Bundle\DDDBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Transformuje obiekty klasy Enum na jego wartości
 *
 * @author Dawid Drelichowski <dawid.drelichowski@netteam.pl>
 */
class EnumsToValuesTransformer implements DataTransformerInterface
{
    private $class;

    /**
     * @param string $class FQN klasy enuma
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($array)
    {
        if (null === $array) {
            return array();
        }

        if (!is_array($array)) {
            throw new TransformationFailedException('Expected an array.');
        }

        $result = array();
        foreach ($array as $enum) {
            array_push($result, $enum->get());
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($array)
    {
        if (null === $array) {
            return array();
        }

        if (!is_array($array)) {
            throw new TransformationFailedException('Expected an array.');
        }

        $result = array();
        foreach ($array as $value) {
            $enum = new EnumToValueTransformer($this->class);
            array_push($result, $enum->reverseTransform($value));
        }

        return $result;
    }
}
