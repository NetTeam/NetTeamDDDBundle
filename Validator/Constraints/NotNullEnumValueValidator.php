<?php

namespace NetTeam\Bundle\DDDBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use NetTeam\DDD\Enum;

/**
 * Sprawdzenie, czy enum posiada poprawną wartość oraz czy nie jest to wartość null
 *
 * @author Wojciech Muła <wojciech.mula@netteam.pl>
 */
class NotNullEnumValueValidator extends EnumValueValidator
{
    /**
     * {@inheritdoc}
     */
    public function isValid($enum, Constraint $constraint)
    {
        if (!parent::isValid($enum, $constraint)) {
            return false;
        }

        if (null !== $enum->get()) {
            return true;
        }

        $this->setMessage($constraint->messageNull);

        return false;
    }
}
