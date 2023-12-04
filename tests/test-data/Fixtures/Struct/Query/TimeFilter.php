<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct\Query;

use Struct\Contracts\StructInterface;

class TimeFilter implements StructInterface
{
    public TimeFilterType $type;
    public string $identifier;
    public string $label;
}
