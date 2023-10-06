<?php

declare(strict_types=1);

namespace Struct\Contracts\Operator;

use Struct\Enum\Operator\Comparison;

interface ComparableInterface
{
    public function compare(self $compareWith): Comparison;
}
