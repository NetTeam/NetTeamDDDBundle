<?php

namespace NetTeam\Bundle\DDDBundle\Form\ChoiceList;

use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use NetTeam\DDD\EnumUtil;

/**
 * Choice list dla Enuma
 *
 * @author Paweł Macyszyn <pawel.macyszyn@netteam.pl>
 */
class EnumChoiceList extends SimpleChoiceList
{
    private $translator;

    public function __construct(TranslatorInterface $translator, $class, $transPrefix, $transDomain, array $choices)
    {
        $this->translator = $translator;

        if (count($choices) === 0) {
            $choices = EnumUtil::createChoiceList($class);
        }

        if ('' !== $transPrefix && null !== $transPrefix) {
            $transPrefix = $transPrefix . '.';
        }

        $translatedChoices = array();
        foreach ($choices as $key => $value) {
            $translatedChoices[$key] = $this->translator->trans($transPrefix . $value, array(), $transDomain);
        }

        parent::__construct($translatedChoices);
    }
}
