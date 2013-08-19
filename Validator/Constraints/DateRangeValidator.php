<?php

namespace NetTeam\Bundle\DDDBundle\Validator\Constraints;

use NetTeam\DDD\ValueObject\DateRange;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\ValidatorException;

/**
 * Validator for DateRange constraint.
 *
 * @author Paweł A. Wacławczyk <p.a.waclawczyk@gmail.com>
 */
class DateRangeValidator extends ConstraintValidator
{

    /**
     * {@inheritdoc}
     */
    public function validate($range, Constraint $constraint)
    {
        if (!$range instanceof DateRange) {
            throw new ValidatorException('Expected instance of "NetTeam\DDD\ValueObject\DateRange".');
        }

        if (null === $range->min() || null === $range->max()) {
            return true;
        }

        if (!$range->min() instanceof \DateTime || !$range->max() instanceof \DateTime) {
            throw new ValidatorException('Expected instances of "\DateTime" as limits.');
        }

        if ($range->min() > $range->max()) {
            $this->context->addViolation($constraint->message);

            return false;
        }

        return true;
    }
}
