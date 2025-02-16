<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct\Base;

use Struct\Contracts\StructInterface;

abstract class AbstractType implements StructInterface
{
    public string $name;
}
