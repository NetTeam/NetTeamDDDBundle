<?php

namespace NetTeam\Bundle\DDDBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use NetTeam\DDD\ValueObject\Range;

class RangeToArrayTransformer implements DataTransformerInterface
{
   public function transform($range)
    {
        if (null === $range) {
            return array('min'=> 0, 'max' => 0);
        }

        if (!$range instanceof Range) {
            throw new TransformationFailedException('Expected a NetTeam\DDD\ValueObject\Range.');
        }

        return array('min'=> $range->min(), 'max' => $range->max());
    }

    public function reverseTransform($value)
    {
        if (null === $value) {
            return null;
        }

        if (!is_array($value)) {
            throw new TransformationFailedException('Expected an array.');
        }

        return new Range($value['min'], $value['max'], false);
    }
}
