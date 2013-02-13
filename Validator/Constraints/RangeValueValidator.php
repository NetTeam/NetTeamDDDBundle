<?php

namespace NetTeam\Bundle\DDDBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use NetTeam\DDD\ValueObject\Range;

/**
 * Checks if Range instance has valid values (min <= max)
 *
 * @author Krzysztof Menżyk <krzysztof.menzyk@netteam.pl>
 */
class RangeValueValidator extends ConstraintValidator
{
    public function validate($range, Constraint $constraint)
    {
        if (!$range instanceof Range) {
            throw new UnexpectedTypeException($range, 'NetTeam\DDD\ValueObject\Range');
        }

        if ($range->getMin() > $range->getMax()) {
            $this->context->addViolation($constraint->message);

            return false;
        }

        return true;
    }
}