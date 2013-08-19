<?php

namespace NetTeam\Bundle\DDDBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Constraint for DateRange.
 *
 * @author Paweł A. Wacławczyk <p.a.waclawczyk@gmail.com>
 *
 * @Annotation
 */
class DateRange extends Constraint
{
    public $message = 'dateRange.lowerLimitIsGreaterThanUpper';

    /**
     * {@inheritDoc}
     */
    public function getTargets()
    {
        return array(self::CLASS_CONSTRAINT, self::PROPERTY_CONSTRAINT);
    }
}
