<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct\Query;

use Struct\Attribute\DefaultValue;
use Struct\Contracts\StructInterface;
use Struct\DataType\Date;

class Period implements StructInterface
{
    #[DefaultValue('2023-11-01')]
    public Date $dateFrom;
    #[DefaultValue('2023-11-30')]
    public Date $dateTo;
}
