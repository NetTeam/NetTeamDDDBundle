<?php

namespace NetTeam\Bundle\DDDBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\RangeValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use NetTeam\DDD\ValueObject\Percent;

/**
 * Waliduje minimalną i maksymalną wartość w obiekcie klasy Percent
 *
 * @author Krzysztof Menżyk <krzysztof.menzyk@netteam.pl>
 */
class PercentRangeValidator extends RangeValidator
{
    /**
     * {@inheritdoc}
     */
    public function validate($percent, Constraint $constraint)
    {
        if (null === $percent) {
            return;
        }

        if (!$percent instanceof Percent) {
            throw new UnexpectedTypeException($percent, 'NetTeam\DDD\ValueObject\Percent');
        }

        return parent::validate($percent->value(), $constraint);
    }
}
