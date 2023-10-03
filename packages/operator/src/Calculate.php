<?php

declare(strict_types=1);

namespace Struct\Operator;

use Struct\Contracts\Operator\IncrementableInterface;

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
}
