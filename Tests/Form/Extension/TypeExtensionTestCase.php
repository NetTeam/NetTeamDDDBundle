<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Form\Extension;

use Symfony\Tests\Component\Form\Extension\Core\Type\TypeTestCase;

/**
 * Bazowa klasa do testów klas implementujących FormTypeExtensionInterface
 *
 * @author Krzysztof Menżyk <krzysztof.menzyk@netteam.pl>
 */
abstract class TypeExtensionTestCase extends TypeTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function getExtensions()
    {
        return array(
            new CoreExtension($this->getTestedExtension()),
        );
    }

    /**
     * Instancja testowanego rozszerzenia
     *
     * @param return Symfony\Component\Form\FormTypeExtensionInterface;
     */
    abstract protected function getTestedExtension();
}
