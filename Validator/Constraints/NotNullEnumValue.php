<?php

namespace NetTeam\Bundle\DDDBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Constraint dla NotNullEnumValueValidator
 *
 * @author Wojciech Muła <wojciech.mula@netteam.pl>
 *
 * @Annotation
 */
class NotNullEnumValue extends EnumValue
{
    public $messageNull = 'enum.not_null';
}
