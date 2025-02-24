<?php

declare(strict_types=1);

namespace Struct\Contracts\Operator;

interface SumInterface
{
    /**
     * @template T of SumInterface
     * @param array<T> $summandList
     * @return T
     */
    public static function sum(array $summandList): self;
}
