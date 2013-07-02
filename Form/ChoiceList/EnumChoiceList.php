<?php

namespace NetTeam\Bundle\DDDBundle\Form\ChoiceList;

use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ArrayChoiceList;
use NetTeam\DDD\EnumUtil;

/**
 * Choice list dla Enuma
 *
 * @author Paweł Macyszyn <pawel.macyszyn@netteam.pl>
 * @author Dawid Drelichowski <dawid.drelichowski@netteam.pl>
 */
class EnumChoiceList extends ArrayChoiceList
{
    private $translator;
    private $prefix = '';
    private $domain;

    public function __construct(TranslatorInterface $translator, $class, $transPrefix, $transDomain, $choices)
    {
        $this->translator = $translator;
        $this->domain     = $transDomain;

        if ('' !== $transPrefix && null !== $transPrefix) {
            $this->prefix = $transPrefix . '.';
        }

        if (null === $choices) {
            $choices = EnumUtil::createChoiceList($class);
        }

        parent::__construct($this->translateArray($choices));
    }

    private function translateArray(array $choices)
    {
        $groups = false;
        $translatedChoices = array();
        foreach ($choices as $key => $choice) {
            if (is_array($choice)) {
                $groups = true;
                $translatedChoices[$key] = $this->translateArray($choice);
                natsort($translatedChoices[$key]);

                continue;
            }

            $translatedChoices[$key] = $this->translator->trans($this->prefix . $choice, array(), $this->domain);
        }

        if (!$groups) {
            natsort($translatedChoices);
        }

        return $translatedChoices;
    }
}
