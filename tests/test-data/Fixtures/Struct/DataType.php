<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use Struct\Attribute\DefaultValue;
use Struct\Contracts\StructInterface;
use Struct\DataType\Amount;
use Struct\DataType\Month;
use Struct\DataType\Rate;

class DataType implements StructInterface
{
    public ?Month $monthNull = null;

    #[DefaultValue('2013-07')]
    public Month $month;

    #[DefaultValue('125.24 EUR')]
    public Amount $amount;

    #[DefaultValue('19 %')]
    public Rate $taxRate;

    #[DefaultValue('19.8 ‰')]
    public Rate $rate;
}
