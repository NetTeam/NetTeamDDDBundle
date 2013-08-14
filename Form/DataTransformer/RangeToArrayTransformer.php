<?php

namespace NetTeam\Bundle\DDDBundle\Form\DataTransformer;

use NetTeam\DDD\ValueObject\Range;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Transformer z Range na wartość tablicę z kluczami "min" i "max"
 *
 * @author Paweł Macyszyn <pawel.macyszyn@netteam.pl>
 */
class RangeToArrayTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($range)
    {
        if (null === $range) {
            return array('min'=> null, 'max' => null);
        }

        if (!$range instanceof Range) {
            throw new TransformationFailedException('Expected a NetTeam\DDD\ValueObject\Range.');
        }

        return array('min'=> $range->min(), 'max' => $range->max());
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($value)
    {
        if (!is_array($value)) {
            throw new TransformationFailedException('Expected an array.');
        }

        return new Range($value['min'], $value['max']);
    }
}
