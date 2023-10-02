<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Fixtures\Struct;

use Struct\DataType\Month;
use Struct\Struct\Contracts\StructInterface;

class DataType implements StructInterface
{
    public Month $month;
}
