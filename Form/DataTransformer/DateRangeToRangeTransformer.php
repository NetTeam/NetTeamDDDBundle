<?php

namespace NetTeam\Bundle\DDDBundle\Form\DataTransformer;

use NetTeam\DDD\ValueObject\DateRange;
use NetTeam\DDD\ValueObject\Range;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class DateRangeToRangeTransformer implements  DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($value)
    {
        if (null === $value) {
            return new Range();
        }

        if (!$value instanceof DateRange) {
            throw new TransformationFailedException('Expected instance of NetTeam\DDD\ValueObject\DateRange.');
        }

        return new Range($value->min(), $value->max());
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($value)
    {
        if (null === $value) {
            return new DateRange();
        }

        if (!$value instanceof Range) {
            throw new TransformationFailedException('Expected instance of NetTeam\DDD\ValueObject\Range.');
        }

        return new DateRange($value->min(), $value->max());
    }
}
