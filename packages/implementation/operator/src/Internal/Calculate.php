<?php

declare(strict_types=1);

namespace Struct\Operator\Internal;

use Exception\Unexpected\UnexpectedException;
use Struct\Contracts\Operator\IncrementableInterface;
use Struct\Contracts\Operator\SignChangeInterface;
use Struct\Contracts\Operator\SumInterface;
use Struct\Exception\Operator\DataTypeException;

/**
 * @internal
 */
final class Calculate extends AbstractOperator
{
    public static function increment(int|IncrementableInterface &$object): void
    {
        if (is_int($object) === true) {
            $object++;
            return;
        }
        $object = $object->increment();
    }

    public static function decrement(int|IncrementableInterface &$object): void
    {
        if (is_int($object) === true) {
            $object--;
            return;
        }
        $object = $object->decrement();
    }

    /**
     * @template T of SumInterface&SignChangeInterface
     * @param T $left
     * @param T $right
     * @return T
     */
    public static function sub(SumInterface&SignChangeInterface $left, SumInterface&SignChangeInterface $right): SumInterface&SignChangeInterface
    {
        $singChangeRight = self::signChange($right);
        return self::add($left, $singChangeRight);
    }

    /**
     * @template T of SumInterface
      * @param T $left
     * @param T $right
     * @return T
     */
    public static function add(SumInterface $left, SumInterface $right): SumInterface
    {
        $result = $left::sum([$left, $right]);
        return $result;
    }

    /**
     * @template T of SumInterface
     * @param array<T> $summandList
     * @return T
     */
    public static function sum(array $summandList): SumInterface
    {
        if (count($summandList) === 0) {
            throw new DataTypeException(1696344860, 'There must be at least one summand');
        }
        foreach ($summandList as $value) {
            if ($value instanceof SumInterface === false) {
                throw new UnexpectedException(1740380661);
            }
        }
        $firstValue = $summandList[0];
        $result = $firstValue::sum($summandList);
        return $result;
    }

    /**
     * @template T of SignChangeInterface
     * @param T $left
     * @return T
     */
    public static function signChange(SignChangeInterface $left): SignChangeInterface
    {
        $result = $left::signChange($left);
        return $result;
    }
}
