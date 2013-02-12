<?php

namespace NetTeam\Bundle\DDDBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use NetTeam\DDD\Enum;

class StringToEnumTransformer implements DataTransformerInterface
{
    private $class;

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

        if (!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        return new $this->class($value, false);
    }
}
