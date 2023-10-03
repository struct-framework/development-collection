<?php

declare(strict_types=1);

namespace Struct\Contracts\Operator;

interface SumInterface
{
    /**
     * @param array<SumInterface> $summandList
     * @return self
     */
    public static function sum(array $summandList): self;
}
