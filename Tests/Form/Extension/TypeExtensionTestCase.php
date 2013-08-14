<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Form\Extension;

use Symfony\Component\Form\Forms;
use Symfony\Component\Form\FormTypeExtensionInterface;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Bazowa klasa do testów klas implementujących FormTypeExtensionInterface
 *
 * @author Krzysztof Menżyk <krzysztof.menzyk@netteam.pl>
 */
abstract class TypeExtensionTestCase extends TypeTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $factoryBuider = Forms::createFormFactoryBuilder();
        foreach ($this->getTypeExtensions() as $extension) {
            $factoryBuider->addTypeExtension($extension);
        }

        $this->factory = $factoryBuider->getFormFactory();
    }

    protected function tearDown()
    {
        parent::tearDown();

        $this->factory = null;
    }

    /**
     * @return FormTypeExtensionInterface[]
     */
    protected function getTypeExtensions()
    {
        return array();
    }
}
