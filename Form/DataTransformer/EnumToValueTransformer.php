<?php

namespace NetTeam\Bundle\DDDBundle\Form\DataTransformer;

use NetTeam\DDD\Enum;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Transformuje obiekt klasy Enum na jego wartość
 *
 * @author Krzysztof Menżyk <krzysztof.menzyk@netteam.pl>
 */
class EnumToValueTransformer implements DataTransformerInterface
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
    public function transform($enum)
    {
        if (null === $enum || '' === $enum) {
            return '';
        }

        if (!$enum instanceof $this->class) {
            throw new TransformationFailedException(sprintf('Expected a %s.', $this->class));
        }

        return $enum->get();
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($value)
    {
        if (null === $value || '' === $value) {
            return new $this->class(Enum::__NULL, false);
        }

        if (!is_scalar($value)) {
            throw new TransformationFailedException('Expected a scalar.');
        }

        return new $this->class($value, false);
    }
}
