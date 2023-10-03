<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use Struct\Contracts\StructInterface;

class Role implements StructInterface
{
    public string $name = '';
}
