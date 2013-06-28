<?php

namespace NetTeam\Bundle\DDDBundle\Twig;

use NetTeam\DDD\Enum;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Rozszerzenie twiga zapewniające tłumaczenie dla Enuma
 */
class TransEnumExtension extends \Twig_Extension
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function getFilters()
    {
        return array(
            'trans_enum' => new \Twig_Filter_Method($this, 'transEnum'),
        );
    }

    public function transEnum(Enum $value, $transPrefix = '', $transDomain = 'messages')
    {
        if ($value->is(Enum::__NULL)) {
            return;
        }

        if ('' !== $transPrefix && null !== $transPrefix) {
            $transPrefix = $transPrefix . '.';
        }

        return $this->translator->trans($transPrefix . $value, array(), $transDomain);
    }

    public function getName()
    {
        return 'trans_enum_extension';
    }
}
