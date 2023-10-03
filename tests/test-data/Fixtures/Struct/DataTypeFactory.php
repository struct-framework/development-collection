<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use Struct\Attribute\DefaultValue;
use Struct\Contracts\StructInterface;
use Struct\DataType\Amount;
use Struct\DataType\Month;

class DataTypeFactory implements StructInterface
{
    public ?Month $monthNull = null;

    public Month $monthUndefined;

    #[DefaultValue('2013-07')]
    public Month $month;

    #[DefaultValue('1258.25 TEUR')]
    public Amount $amount;
}
