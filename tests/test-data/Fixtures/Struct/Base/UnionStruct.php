<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct\Base;

use Struct\Contracts\StructInterface;
use Struct\DataType\Amount;

class UnionStruct implements StructInterface
{
    public string|Amount $turnOverTest = '857';
}
