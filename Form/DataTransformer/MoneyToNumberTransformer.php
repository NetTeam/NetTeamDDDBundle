<?php

namespace NetTeam\Bundle\DDDBundle\Form\DataTransformer;

use NetTeam\DDD\ValueObject\Money;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Transformuje value object Money na wartość numeryczną
 *
 * @author Paweł A. Wacławczyk <p.a.waclawczyk@gmail.com>
 * @author Krzysztof Menżyk <krzysztof.menzyk@netteam.pl>
 */
class MoneyToNumberTransformer implements DataTransformerInterface
{
    /**
     * Waluta
     *
     * @var string
     */
    private $currency;

    /**
     * @param string $currency
     */
    public function __construct($currency)
    {
        $this->currency = $currency;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($money)
    {
        if (null === $money) {
            return null;
        }

        if (!$money instanceof Money) {
            throw new TransformationFailedException('Expected a NetTeam\DDD\ValueObject\Money.');
        }

        return $money->amount();
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($number)
    {
        if (null === $number) {
            return null;
        }

        if (!is_numeric($number)) {
            throw new TransformationFailedException('Expected a numeric.');
        }

        return new Money($number, $this->currency);
    }
}
