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

        $factoryBuilder = Forms::createFormFactoryBuilder();
        foreach ($this->getTypeExtensions() as $extension) {
            $factoryBuilder->addTypeExtension($extension);
        }

        $this->factory = $factoryBuilder->getFormFactory();
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
