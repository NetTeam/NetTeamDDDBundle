<?php

namespace NetTeam\Bundle\DDDBundle\Form\DataTransformer;

use NetTeam\DDD\ValueObject\MoneyRange;
use NetTeam\DDD\ValueObject\Range;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Transformer z ObjectValue MoneyRange na Range
 *
 * @author Paweł Macyszyn <pawel.macyszyn@netteam.pl>
 */
class MoneyRangeToRangeTransformer implements DataTransformerInterface
{
    /**
     * @param MoneyRange
     *
     * @return Range
     */
    public function transform($value)
    {
        if (null === $value) {
            return null;
        }

        if (!$value instanceof MoneyRange) {
            throw new \UnexpectedValueException('Required object of type NetTeam\DDD\ValueObject\MoneyRange');
        }

        return new Range($value->min(), $value->max());
    }

    /**
     * @param Range
     *
     * @return MoneyRange
     */
    public function reverseTransform($value)
    {
        if (!$value instanceof Range) {
            throw new \UnexpectedValueException('Required object of type NetTeam\DDD\ValueObject\Range');
        }

        return new MoneyRange($value->min(), $value->max());
    }
}
