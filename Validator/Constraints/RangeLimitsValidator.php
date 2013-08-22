<?php

namespace NetTeam\Bundle\DDDBundle\Validator\Constraints;

use NetTeam\DDD\ValueObject\Range;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\ValidatorException;
use Doctrine\Common\Comparable;

/**
 * RangeLimitsValidator validates that lower limit of range is lower or equal to upper limit.
 * Validated value must implement NetTeam\DDD\ValueObject\Range.
 * Limits must be comparable via `<=>` operators or implement Doctrine\Common\Comparable.
 *
 * @author Paweł A. Wacławczyk <p.a.waclawczyk@gmail.com>
 */
class RangeLimitsValidator extends ConstraintValidator
{
    /**
     * {@inheritdoc}
     */
    public function validate($range, Constraint $constraint)
    {
        if (!$range instanceof Range) {
            throw new ValidatorException('Expected instance of NetTeam\DDD\ValueObject\Range.');
        }

        if (null === $range->min() || null === $range->max()) {
            return true;
        }

        if ($range->min() instanceof Comparable && 1 === $range->min()->compareTo($range->max())) {
            $this->context->addViolation($constraint->message);

            return false;
        }

        if ($range->min() > $range->max()) {
            $this->context->addViolation($constraint->message);

            return false;
        }

        return true;
    }
}
