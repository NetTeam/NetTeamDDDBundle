<?php

namespace NetTeam\Bundle\DDDBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Constraint for RangeValidator
 *
 * @author Krzysztof Menżyk <krzysztof.menzyk@netteam.pl>
 *
 * @Annotation
 */
class RangeValue extends Constraint
{
    public $message = 'range.invalid_value';

    /**
     * {@inheritDoc}
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
