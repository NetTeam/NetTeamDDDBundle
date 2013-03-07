<?php

namespace NetTeam\Bundle\DDDBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use NetTeam\DDD\Enum;

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

    public function transform($enum)
    {
        if (null === $enum || '' === $enum) {
            return '';
        }

        if (!$enum instanceof $this->class) {
            throw new UnexpectedTypeException($enum, $this->class);
        }

        return $enum->get();
    }

    public function reverseTransform($value)
    {
        if (null === $value || '' === $value) {
            return new $this->class(Enum::__NULL, false);
        }

        if (!is_scalar($value)) {
            throw new UnexpectedTypeException($value, 'scalar');
        }

        return new $this->class($value, false);
    }
}
