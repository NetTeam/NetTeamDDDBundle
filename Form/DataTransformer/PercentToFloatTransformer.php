<?php

namespace NetTeam\Bundle\DDDBundle\Form\DataTransformer;

use NetTeam\DDD\ValueObject\Percent;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Transformer z ObjectValue Percent na float
 *
 * @author Paweł Macyszyn <pawel.macyszyn@netteam.pl>
 */
class PercentToFloatTransformer implements DataTransformerInterface
{
    /**
     * @param Percent $value
     *
     * @return float
     */
    public function transform($value)
    {
        if (!$value instanceof Percent) {
            throw new \UnexpectedValueException('Required object of type NetTeam\DDD\ValueObject\Percent');
        }

        return $value->value();
    }

    /**
     * @param float $value
     *
     * @return Percent
     */
    public function reverseTransform($value)
    {
        if (!is_numeric($value)) {
            throw new \UnexpectedValueException('Required numeric value');
        }

        return new Percent($value);
    }
}
