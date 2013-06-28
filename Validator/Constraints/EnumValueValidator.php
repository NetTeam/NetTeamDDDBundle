<?php

namespace NetTeam\Bundle\DDDBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use NetTeam\DDD\Enum;

/**
 * Sprawdza, czy Enum posiada poprawną wartość
 *
 * @author Krzysztof Menżyk <krzysztof.menzyk@netteam.pl>
 */
class EnumValueValidator extends ConstraintValidator
{

    /**
     * {@inheritdoc}
     */
    public function validate($enum, Constraint $constraint)
    {
        if (!$enum instanceof Enum) {
            throw new UnexpectedTypeException($enum, 'NetTeam\DDD\Enum');
        }

        $refl = new \ReflectionClass($enum);

        if (!in_array($enum->get(), array_values($refl->getConstants()))) {
            $this->context->addViolation($constraint->message);

            return false;
        }

        return true;
    }
}
