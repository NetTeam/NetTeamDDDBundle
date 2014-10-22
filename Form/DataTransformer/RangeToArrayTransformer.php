<?php

namespace NetTeam\Bundle\DDDBundle\Form\DataTransformer;

use NetTeam\DDD\ValueObject\Range;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Transformer z Range na wartość tablicę z kluczami "min" i "max"
 *
 * @author Paweł Macyszyn <pawel.macyszyn@netteam.pl>
 */
class RangeToArrayTransformer implements DataTransformerInterface
{
    /**
     * @var string
     */
    private $rangeClass;

    /**
     * @param string $rangeClass
     */
    public function __construct($rangeClass = 'NetTeam\DDD\ValueObject\Range')
    {
        if ($rangeClass !== 'NetTeam\DDD\ValueObject\Range' && !in_array('NetTeam\DDD\ValueObject\Range', class_parents($rangeClass))) {
            throw new \InvalidArgumentException('Expected instance of "NetTeam\DDD\ValueObject\Range".');
        }

        $this->rangeClass = $rangeClass;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($range)
    {

        if (null === $range) {
            return array('min'=> null, 'max' => null);
        }

        if (!$range instanceof $this->rangeClass) {
            throw new TransformationFailedException(sprintf('Expected instance of "%s".', $this->rangeClass));
        }

        return array('min'=> $range->min(), 'max' => $range->max());
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($value)
    {
        if (!is_array($value)) {
            throw new TransformationFailedException('Expected an array.');
        }

        return new $this->rangeClass($value['min'], $value['max']);
    }
}
