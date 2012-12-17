<?php

namespace NetTeam\Bundle\DDDBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Constraint for EnumValueValidator
 *
 * @author Krzysztof Menżyk <krzysztof.menzyk@netteam.pl>
 *
 * @Annotation
 */
class EnumValue extends Constraint
{
    public $message = 'enum.invalid_value';

    /**
     * {@inheritDoc}
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
