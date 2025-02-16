<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct\Base;

use Struct\Attribute\ArrayKeyList;
use Struct\Contracts\StructInterface;
use Struct\DataType\Amount;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Fixtures\Struct\Enum\Category;
use Struct\TestData\Fixtures\Struct\Tag;

abstract class AbstractType implements StructInterface
{
    public string $name;
}
