<?php

namespace NetTeam\Bundle\DDDBundle\Form\DataTransformer;

use NetTeam\DDD\ValueObject\Percent;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Transformer z ObjectValue Percent na wartość numeryczną
 *
 * @author Paweł Macyszyn <pawel.macyszyn@netteam.pl>
 */
class PercentToNumberTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($value)
    {
        if (null === $value) {
            return null;
        }

        if (!$value instanceof Percent) {
            throw new TransformationFailedException('Expected a NetTeam\DDD\ValueObject\Percent.');
        }

        return $value->value();
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($value)
    {
        if (null === $value) {
            return null;
        }

        if (!is_numeric($value)) {
            throw new TransformationFailedException('Expected a numeric.');
        }

        return new Percent($value);
    }
}
