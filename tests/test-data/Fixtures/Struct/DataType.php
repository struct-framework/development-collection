<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use Struct\Attribute\DefaultValue;
use Struct\Contracts\StructInterface;
use Struct\DataType\Amount;
use Struct\DataType\Month;

class DataType implements StructInterface
{
    public ?Month $monthNull = null;

    #[DefaultValue('2013-07')]
    public Month $month;

    public Amount $amount;
}
