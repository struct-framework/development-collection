<?php

declare(strict_types=1);

namespace Struct\Enum\Operator;

enum Comparison
{
    case equal;
    case notEqual;
    case greaterThan;
    case lessThan;
}
