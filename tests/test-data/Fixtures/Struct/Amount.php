<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct;

use Struct\Contracts\StructInterface;

class Amount implements StructInterface
{
    public int $value = 200;
    public string $currency = 'EUR';
}
