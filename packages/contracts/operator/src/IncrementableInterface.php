<?php

declare(strict_types=1);

namespace Struct\Contracts\Operator;

interface IncrementableInterface
{
    public function increment(): void;
    public function decrement(): void;
}
