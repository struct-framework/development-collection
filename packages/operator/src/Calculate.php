<?php

declare(strict_types=1);

namespace Struct\Operator;

use Struct\Contracts\Operator\IncrementableInterface;
use Struct\Contracts\Operator\SumInterface;
use Struct\Exception\Operator\SumException;

final class Calculate
{
    public static function increment(IncrementableInterface $object): void
    {
        $object->increment();
    }

    public static function decrement(IncrementableInterface $object): void
    {
        $object->decrement();
    }

    /**
     * @template T of SumInterface
     * @param array<T> $summandList
     * @return T
     */
    public static function sum(array $summandList): SumInterface
    {
        if (count($summandList) === 0) {
            throw new SumException('There must be at least one summand', 1696344860);
        }
        $summand01 = $summandList[0];
        /** @var class-string<SumInterface> $className */
        $className = $summand01::class;
        $result = $className::sum($summandList);
        return $result;
    }
}
