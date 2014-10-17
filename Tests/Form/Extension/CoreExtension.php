<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Form\Extension;

use Symfony\Component\Form\Extension\Core\CoreExtension as BaseCoreExtensions;
use Symfony\Component\Form\FormTypeExtensionInterface;

/**
 * Extension w rozumieniu Symfony2.0 to zbiór typów i rozszerzeń
 * do nich. BaseCoreExtensions jest defaultowym zbiorem, testowy
 * CoreExtension dodaje dokładnie jedno rozszerzenie, które chcemy
 * przetestować.
 */
class CoreExtension extends BaseCoreExtensions
{
    private $extension;

    /**
     * @param FormTypeExtensionInterface $extension
     */
    public function __construct(FormTypeExtensionInterface $extension)
    {
        $this->extension = $extension;
    }

    /**
     * {@inheritdoc}
     */
    protected function loadTypeExtensions()
    {
        return array($this->extension);
    }
}
