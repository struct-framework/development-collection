<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use Struct\Contracts\StructInterface;

class Tag implements StructInterface
{
    public string $name = '';
}
