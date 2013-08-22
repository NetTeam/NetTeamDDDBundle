<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Validator\Constraints;

use NetTeam\Bundle\DDDBundle\Validator\Constraints\RangeLimits;
use Symfony\Component\Validator\Constraint;

/**
 * @author Paweł A. Wacławczyk <p.a.waclawczyk@gmail.com>
 *
 * @group Unit
 */
class RangeLimitsTest extends \PHPUnit_Framework_TestCase
{
    private $constraint;

    protected function setUp()
    {
        $this->constraint = new RangeLimits();
    }

    public function testIfConstarinetCanBeAppliedToClass()
    {
        $this->assertContains(Constraint::CLASS_CONSTRAINT, $this->constraint->getTargets());
    }

    public function testIfConstarinetCanBeAppliedToProperty()
    {
        $this->assertContains(Constraint::PROPERTY_CONSTRAINT, $this->constraint->getTargets());
    }
}
