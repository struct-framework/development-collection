<?php

declare(strict_types=1);

namespace Struct\Contracts\Operator;

interface SignChangeInterface
{
    /**
     * @template T of SignChangeInterface
     * @param T $left
     * @return T
     */
    public static function signChange(self $left): self;
}
