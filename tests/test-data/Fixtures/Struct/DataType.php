<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use Struct\Contracts\StructInterface;
use Struct\DataType\Amount;
use Struct\DataType\Month;

class DataType implements StructInterface
{
    public Month $month;

    public Amount $amount;
}
