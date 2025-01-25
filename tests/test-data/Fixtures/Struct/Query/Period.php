<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct\Query;

use Struct\Attribute\DefaultValue;
use Struct\Contracts\StructInterface;
use Struct\DataType\Date\DateWritableOld;

class Period implements StructInterface
{
    #[DefaultValue('2023-11-01')]
    public DateWritableOld $dateFrom;
    #[DefaultValue('2023-11-30')]
    public DateWritableOld $dateTo;
}
