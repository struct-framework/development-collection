<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct\Enum;

enum Rating: int
{
    case Top = 1;
    case Middle = 2;
    case Low = 3;
}
