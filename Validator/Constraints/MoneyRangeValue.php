<?php

namespace NetTeam\Bundle\DDDBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Constraint for MoneyRange.
 *
 * @author Paweł Wacławczyk <pawel.waclawczyk@netteam.pl>
 *
 * @Annotation
 */
class MoneyRangeValue extends Constraint
{
    public $message = 'moneyRange.invalidValue';

    /**
     * {@inheritDoc}
     */
    public function getTargets()
    {
        return array(self::CLASS_CONSTRAINT, self::PROPERTY_CONSTRAINT);
    }
}
