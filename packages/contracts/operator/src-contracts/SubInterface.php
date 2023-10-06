<?php

declare(strict_types=1);

namespace Struct\Contracts\Operator;

interface SubInterface
{
    /**
     * @template T of SubInterface
     * @param T $minuend
     * @param T $subtrahend
     * @return T
     */
    public static function sub(self $minuend, self $subtrahend): self;
}
