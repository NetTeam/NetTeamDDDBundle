<?php

namespace NetTeam\Bundle\DDDBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * {@inheritdoc}
 *
 * @author Paweł A. Wacławczyk <p.a.waclawczyk@gmail.com>
 *
 * @Annotation
 */
class RangeLimits extends Constraint
{
    public $message = 'rangeLimits.lowerLimitIsGreaterThanUpperLimit';

    public $instanceOf;

    /**
     * {@inheritdoc}
     */
    public function getTargets()
    {
        return array(
            self::CLASS_CONSTRAINT,
            self::PROPERTY_CONSTRAINT,
        );
    }
}
