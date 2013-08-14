<?php

namespace NetTeam\Bundle\DDDBundle\Validator\Constraints;

use NetTeam\DDD\ValueObject\MoneyRange;
use NetTeam\DDD\ValueObject\Money;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\ValidatorException;

/**
 * Validator for MoneyRange.
 *
 * @author Paweł Wacławczyk <pawel.waclawczyk@netteam.pl>
 */
class MoneyRangeValidator extends ConstraintValidator
{

    /**
     * {@inheritdoc}
     */
    public function validate($range, Constraint $constraint)
    {
        if (!$range instanceof MoneyRange) {
            throw new ValidatorException('Expected instance of "NetTeam\DDD\ValueObject\MoneyRange".');
        }

        if (null === $range->min() || null === $range->max()) {
            return true;
        }

        if (!$range->min() instanceof Money || !$range->max() instanceof Money) {
            throw new ValidatorException('Expected instances of "NetTeam\DDD\ValueObject\Money" as limits.');
        }

        if ($range->min()->currency() !== $range->max()->currency()) {
            $this->context->addViolation('moneyRange.differentLimitsCurrencies');

            return false;
        }

        if (1 === $range->min()->compareTo($range->max())) {
            $this->context->addViolation('moneyRange.lowerLimitIsGreaterThanUpper');

            return false;
        }

        return true;
    }
}
