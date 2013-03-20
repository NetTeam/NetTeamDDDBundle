<?php

namespace NetTeam\Bundle\DDDBundle\Form\ChoiceList;

use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ArrayChoiceList;
use NetTeam\DDD\EnumUtil;

/**
 * Choice list dla Enuma
 *
 * @author Paweł Macyszyn <pawel.macyszyn@netteam.pl>
 */
class EnumChoiceList extends ArrayChoiceList
{
    private $translator;

    public function __construct(TranslatorInterface $translator, $class, $transPrefix, $transDomain, $choices)
    {
        $this->translator = $translator;

        if (null === $choices) {
            $choices = EnumUtil::createChoiceList($class);
        }

        foreach ($choices as $key => $value) {
            $this->choices[$key] = $this->translator->trans($transPrefix . '.' . $value, array(), $transDomain);
        }
    }

    public function getChoices()
    {
        return $this->choices;
    }
}
